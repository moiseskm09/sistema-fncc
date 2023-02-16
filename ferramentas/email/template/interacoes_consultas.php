<?php
    $mail->Subject = 'Nova Interação na consulta - (Nº #'.str_pad($cod_consulta, 6, '0', STR_PAD_LEFT).')';
    $mail->Body = '<p>A consulta (Nº #'.str_pad($cod_consulta, 6, '0', STR_PAD_LEFT).') foi alterada.</p><p>Clique no link abaixo para abrir o sistema e visualizar os detalhes da consulta<br>https://bemktech.com.br/sistema-fncc/?cce='.$cod_consulta.'</p><p>Essa é uma mensagem automática do sistema, por favor não responda!<br> <strong>FNCC</strong></p>';
?>