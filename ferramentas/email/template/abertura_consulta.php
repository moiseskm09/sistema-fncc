<?php
    $mail->Subject = 'Nova Consulta Aberta - (Nº #'.str_pad($codConsulta, 6, '0', STR_PAD_LEFT).')';
    $mail->Body = '<p>A consulta (Nº #'.str_pad($codConsulta, 6, '0', STR_PAD_LEFT).') foi aberta pelo usuário: <strong>'.$nomeUserAberturaConsulta.'</strong> da Cooperativa: <strong>'.$cooperativaUserAberturaConsulta.'</strong></p><p>Clique no link abaixo para abrir o sistema e visualizar os detalhes da consulta<br>https://bemktech.com.br/sistema-fncc/?cce='.$codConsulta.'</p><p>Essa é uma mensagem automática do sistema, por favor não responda!<br> <strong>FNCC</strong></p>';
?>