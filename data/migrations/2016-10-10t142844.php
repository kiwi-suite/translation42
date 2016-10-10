<?php
class Migration20161010142844
{

    public function up(\Zend\ServiceManager\ServiceManager $serviceManager)
    {
        $sql = "CREATE TABLE `translation42_translation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `textDomain` varchar(255) NOT NULL,
  `locale` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `translation` text,
  `status` enum('auto','manual') NOT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `text_domain_locale_message_UNIQUE` (`textDomain`,`locale`,`message`),
  KEY `text_domain_message_idx` (`textDomain`,`message`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        $serviceManager->get('Db\Master')->query($sql, \Zend\Db\Adapter\Adapter::QUERY_MODE_EXECUTE);
    }

    public function down(\Zend\ServiceManager\ServiceManager $serviceManager)
    {
        $sql = "DROP TABLE `translation42_translation`";
        $serviceManager->get('Db\Master')->query($sql, \Zend\Db\Adapter\Adapter::QUERY_MODE_EXECUTE);
    }


}
