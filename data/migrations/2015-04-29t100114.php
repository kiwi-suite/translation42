<?php

class Migration20150429100114
{

    public function up(Zend\ServiceManager\ServiceManager $serviceManager)
    {
        $sql
            = "# noinspection SqlNoDataSourceInspection
CREATE TABLE `translation42_translation` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `textDomain` VARCHAR(255) NOT NULL,
  `locale` VARCHAR(255) NOT NULL,
  `message` VARCHAR(255) NOT NULL,
  `translation` TEXT DEFAULT NULL,
  `status` ENUM('auto', 'manual') NOT NULL,
  `updated` DATETIME NOT NULL,
  `created` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `text_domain_locale_message_UNIQUE` (`textDomain`, `locale`, `message`),
  INDEX `text_domain_message_idx` (`textDomain`, `message`))
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci";
        $serviceManager->get('Db\Master')->query($sql, \Zend\Db\Adapter\Adapter::QUERY_MODE_EXECUTE);
    }

    public function down(Zend\ServiceManager\ServiceManager $serviceManager)
    {
        $sql = "# noinspection SqlNoDataSourceInspection
DROP TABLE `translation42_translation`";
        $serviceManager->get('Db\Master')->query($sql, \Zend\Db\Adapter\Adapter::QUERY_MODE_EXECUTE);
    }


}
