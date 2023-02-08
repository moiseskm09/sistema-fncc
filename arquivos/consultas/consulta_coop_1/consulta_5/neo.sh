#!/bin/bash

LOG=/bkp_neo/log/log_backup`date +%Y%m%d`.txt

echo "  -- Gravando log em $LOG"
exec 1>>${LOG}
exec 2>&1
echo "***Iniciando processo - `date +%d/%m/%Y" - "%H:%M:%S`***"

##Verificando conecexão com o banco de dados
echo "  -- Verificando conexao com o banco de dados ..."
/arius/bin/postgres/pgsql/bin/pg_isready -h 127.0.0.1 > /dev/null 2>&1
CONEXAO=$?

if [ $CONEXAO -eq 0 ] ;then
echo '  -- Conexao estabelecida com o banco de dados ...'
echo '  -- Continunado processo de backup ...'
# Definindo parametros do postgres
PG_DUMP=/arius/bin/postgres/pgsql/bin/pg_dump
SERVIDOR='127.0.0.1'
DB_NAME=postgres
ARQUIVO='backup_dbarius'
ARQUIVO_MOV='backup_mov_dbarius'
FORMATO='.sql'
DIR_PRINCIPAL=/bkp_neo/arquivos
DIR_DB=base_de_dados
DIR_XML=xml
DIR_MOVIMENTO=base_movimento
rm /bkp_neo/nome_loja.txt > /dev/null 2>&1
psql -A -t -h 127.0.0.1 -d postgres -c "SELECT nomefantasia FROM arius.loja  order by codigo asc LIMIT 1" >> /bkp_neo/nome_loja.txt
FANTASIA=$(sed 's/ \| \| /_/g' /bkp_neo/nome_loja.txt)
MONO_MULTILOJA=$(psql -A -t -h 127.0.0.1 -d postgres -c "SELECT count(codigo) FROM arius.loja")
DIR_XML_ORIGINAL=/arius/arquivos/saida/xml
DESTINO_FTP=/home/frente/master/NEO/$FANTASIA
EXCLUSAO_TABELA='-T cargagerada -T cliente -T finalizadoravalor -T finalizadoravalordoc -T mercadoria -T mercadoriacomposicao -T mercadoriacomposicaopreco -T mercadoriapreco -T mercadoriatribicms -T mercadoriatribpc -T tributoibpt -T registrodiario -T registrodiariofinalizadora -T registrodiarioitem -T liberacao -T pdvvalor -T venda -T vendaitem -T vendaitemcompvalor -T vendaitemvasilhame -T vendapedido -T vendapendenciasefaz -T vendasatnfce'
TABELAS_MOVIMENTO='-t cargagerada -t cliente -t finalizadoravalor -t finalizadoravalordoc -t mercadoria -t mercadoriacomposicao -t mercadoriacomposicaopreco -t mercadoriapreco -t mercadoriatribicms -t mercadoriatribpc -t tributoibpt -t registrodiario -t registrodiariofinalizadora -t registrodiarioitem -t liberacao -t pdvvalor -t venda -t vendaitem -t vendaitemcompvalor -t vendaitemvasilhame -t vendapedido -t vendapendenciasefaz -t vendasatnfce' 
COMANDOS_ADICIONAIS='-c --if-exists'

if [ $MONO_MULTILOJA -gt 1 ] ;then
LOJA='MULTILOJA'
mkdir -p $DIR_PRINCIPAL/$DIR_DB/$FANTASIA/$LOJA
chmod 777 $DIR_PRINCIPAL/$DIR_DB/$FANTASIA/$LOJA > /dev/null 2>&1
else
LOJA=$(psql -A -t -h 127.0.0.1 -d postgres -c "SELECT sigla FROM arius.loja")
mkdir -p $DIR_PRINCIPAL/$DIR_DB/$FANTASIA/$LOJA
chmod 777 $DIR_PRINCIPAL/$DIR_DB/$FANTASIA/$LOJA > /dev/null 2>&1
fi

BACKUP_BASE_DIR=$DIR_PRINCIPAL/$DIR_DB/$FANTASIA/$LOJA
BACKUP_XML_DIR=$DIR_PRINCIPAL/$DIR_XML
BACKUP_MOV_DIR=$DIR_PRINCIPAL/$DIR_MOVIMENTO

#Gerando arquivo de backup da base de dados
echo "  -- Gerando backup da base de dados em $BACKUP_BASE_DIR ..."
$PG_DUMP -h $SERVIDOR $DB_NAME  $EXCLUSAO_TABELA $COMANDOS_ADICIONAIS > $BACKUP_BASE_DIR/$ARQUIVO$FORMATO
wait

# Compactando base de dados em tar
echo "  -- Compactando o arquivo $ARQUIVO$FORMATO em $ARQUIVO`date +%d%m%Y`.tar.gz ..."
tar -zcf $BACKUP_BASE_DIR/$ARQUIVO`date +%d%m%Y`.tar.gz $BACKUP_BASE_DIR/$ARQUIVO$FORMATO > /dev/null 2>&1
wait

# Excluindo arquivo sql da base de dados
echo "  -- Excluindo arquivo sql da base de dados ..."
find $BACKUP_BASE_DIR/ -name '*.sql' -exec rm {} \; 

echo "  -- Gerando backup dos arquivos de configurações"
tar -zcf $BACKUP_BASE_DIR/config.tar.gz /arius/inicia_servidor /arius/bin/servidor.cfg /arius/bin/tomcat/webapps/AriusPdvServer.war  &> /dev/null
wait

# Enviar arquivo da base de dados para FTP
echo "  -- Enviando arquivo $ARQUIVO`date +%d%m%Y`.tar.gz para a FTP da Arius"
rclone sync $BACKUP_BASE_DIR bemkneo:$DESTINO_FTP/$LOJA
wait

#Backup arquivos XML
DIA_ANTERIOR=`date -d"1 days ago" "+%d%m%y"`
echo "  -- Gerando backup dos arquivos XML'S do dia `date -d"1 days ago" "+%d/%m/%Y"` ..."
tar -zcf $BACKUP_XML_DIR/xmls$DIA_ANTERIOR.tar.gz $DIR_XML_ORIGINAL/$DIA_ANTERIOR > /dev/null 2>&1
wait

#Gerando arquivo de backup da base de dados de movimento
echo "  -- Gerando backup da base de dados de movimento em $BACKUP_MOV_DIR ..."
$PG_DUMP -h $SERVIDOR $DB_NAME  $TABELAS_MOVIMENTO $COMANDOS_ADICIONAIS > $BACKUP_MOV_DIR/$ARQUIVO_MOV$FORMATO
wait

# Compactando base de movimento em tar
echo "  -- Compactando o arquivo $ARQUIVO_MOV$FORMATO EM $ARQUIVO_MOV`date +%d%m%Y`.tar.gz ..."
tar -zcf $BACKUP_MOV_DIR/$ARQUIVO_MOV`date +%d%m%Y`.tar.gz $BACKUP_MOV_DIR/$ARQUIVO_MOV$FORMATO > /dev/null 2>&1
wait

# Excluindo arquivo sql da base de movimento
echo "  -- Excluindo arquivo sql da base de movimento..."
find $BACKUP_MOV_DIR/ -name '*.sql' -exec rm {} \; 

# Excluindo arquivos desnecessarios
echo "  -- Excluindo arquivos desnecessarios ..."
find $BACKUP_BASE_DIR/ -ctime +5 -exec rm -rf {} \;
find $BACKUP_MOV_DIR/ -ctime +2 -exec rm -rf {} \;
find $BACKUP_XML_DIR/ -ctime +10 -exec rm -rf {} \;
find /bkp_neo/log/ -ctime +5 -exec rm -rf {} \;

else
echo "  -- Nao foi possivel estabelecer uma conexao com o banco de dados, backup interrompido!"
fi

echo "***Finalizando processo - `date +%d/%m/%Y" - "%H:%M:%S`***"