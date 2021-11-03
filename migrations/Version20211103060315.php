<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Class Version20211103060315
 * @package DoctrineMigrations
 */
final class Version20211103060315 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Setup videoclub app';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->addSql($this->upSetupApp());
    }

    /**
     * @return string
     */
    private function upSetupApp(): string
    {
        return <<<SQL

            DROP TABLE IF EXISTS `movie`;
            CREATE TABLE `movie` (
                  `movie_id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` varchar(45) NOT NULL,
                  `description` varchar(255) NOT NULL,
                  `unit_price` decimal(12,2) NOT NULL DEFAULT '0.00',
                  `is_active` tinyint(1) NOT NULL DEFAULT '1',
                  `type_id` int(11) NOT NULL,
                  `created_at` datetime NOT NULL,
                  `updated_at` datetime DEFAULT NULL,
                  PRIMARY KEY (`movie_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            
            DROP TABLE IF EXISTS `movie_type`;
            CREATE TABLE `movie_type` (
                  `movie_type_id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` varchar(45) NOT NULL,
                  `is_active` tinyint(1) NOT NULL DEFAULT '1',
                  `created_at` datetime DEFAULT NULL,
                  `updated_at` datetime DEFAULT NULL,
                  PRIMARY KEY (`movie_type_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            
            INSERT INTO `movie_type` (`name`, `is_active`, `created_at`) VALUES ('Nuevos lanzamientos',1,now()), ('Películas normales',1,now()), ('Películas viejas',1,now());
SQL;
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->addSql($this->downSetupApp());
    }

    /**
     * @return string
     */
    private function downSetupApp(): string
    {
        return <<<SQL
            DROP TABLE IF EXISTS `movie`;
            DROP TABLE IF EXISTS `movie_type`;
SQL;
    }
}
