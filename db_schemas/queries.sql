/*El profesor no debe de depender de ninguna escuela*/
ALTER TABLE `usuarios_profesores` CHANGE `escuela_id` `escuela_id` INT(11) NULL;
ALTER TABLE `usuarios_profesores` ADD `paquete_id` INT NOT NULL AFTER `activo`;
ALTER TABLE `grupos_info` CHANGE `usuario_escuela_id` `usuario_escuela_id` INT(11) NULL;
ALTER TABLE `grupos_info` CHANGE `usuario_escuela_id` `usuario_profesor_id` INT(11) NOT NULL;
