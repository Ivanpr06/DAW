<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260210184411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE CN_API.categoria (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, imagen VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE CN_API.genero (id INT AUTO_INCREMENT NOT NULL, id_api INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE CN_API.ranking (id INT AUTO_INCREMENT NOT NULL, id_categoria INT DEFAULT NULL, id_usuario INT DEFAULT NULL, INDEX IDX_C82C907ACE25AE0A (id_categoria), INDEX IDX_C82C907AFCF8192D (id_usuario), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE CN_API.ranking_serie (id INT AUTO_INCREMENT NOT NULL, position INT NOT NULL, id_serie INT DEFAULT NULL, id_ranking INT DEFAULT NULL, INDEX IDX_2EE5A16144BFD204 (id_serie), INDEX IDX_2EE5A1615E2590A0 (id_ranking), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE CN_API.serie (id INT AUTO_INCREMENT NOT NULL, idApi INT NOT NULL, original_name VARCHAR(255) NOT NULL, overview LONGTEXT NOT NULL, popularity DOUBLE PRECISION NOT NULL, poster_path VARCHAR(500) NOT NULL, first_air_date VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, vote_average DOUBLE PRECISION NOT NULL, vote_count INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE CN_API.usuario (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, correo VARCHAR(255) NOT NULL, contrasena VARCHAR(500) NOT NULL, imagen VARCHAR(255) NOT NULL, rol JSON NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE CN_API.valoracion (id INT AUTO_INCREMENT NOT NULL, nota DOUBLE PRECISION NOT NULL, fecha DATE NOT NULL, comentario LONGTEXT NOT NULL, id_serie INT DEFAULT NULL, id_usuario INT DEFAULT NULL, INDEX IDX_317568F744BFD204 (id_serie), INDEX IDX_317568F7FCF8192D (id_usuario), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE CN_API.ranking ADD CONSTRAINT FK_C82C907ACE25AE0A FOREIGN KEY (id_categoria) REFERENCES CN_API.categoria (id)');
        $this->addSql('ALTER TABLE CN_API.ranking ADD CONSTRAINT FK_C82C907AFCF8192D FOREIGN KEY (id_usuario) REFERENCES CN_API.usuario (id)');
        $this->addSql('ALTER TABLE CN_API.ranking_serie ADD CONSTRAINT FK_2EE5A16144BFD204 FOREIGN KEY (id_serie) REFERENCES CN_API.serie (id)');
        $this->addSql('ALTER TABLE CN_API.ranking_serie ADD CONSTRAINT FK_2EE5A1615E2590A0 FOREIGN KEY (id_ranking) REFERENCES CN_API.ranking (id)');
        $this->addSql('ALTER TABLE CN_API.valoracion ADD CONSTRAINT FK_317568F744BFD204 FOREIGN KEY (id_serie) REFERENCES CN_API.serie (id)');
        $this->addSql('ALTER TABLE CN_API.valoracion ADD CONSTRAINT FK_317568F7FCF8192D FOREIGN KEY (id_usuario) REFERENCES CN_API.usuario (id)');
        $this->addSql('ALTER TABLE ranking DROP FOREIGN KEY `fk_ranking_categoria`');
        $this->addSql('ALTER TABLE ranking DROP FOREIGN KEY `fk_ranking_usuario`');
        $this->addSql('ALTER TABLE ranking_serie DROP FOREIGN KEY `fk_ranking_serie_ranking`');
        $this->addSql('ALTER TABLE ranking_serie DROP FOREIGN KEY `fk_ranking_serie_serie`');
        $this->addSql('ALTER TABLE valoracion DROP FOREIGN KEY `fk_valoracion_serie`');
        $this->addSql('ALTER TABLE valoracion DROP FOREIGN KEY `fk_valoracion_usuario`');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE genero');
        $this->addSql('DROP TABLE ranking');
        $this->addSql('DROP TABLE ranking_serie');
        $this->addSql('DROP TABLE serie');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE valoracion');
        $this->addSql('ALTER TABLE serie_genero DROP FOREIGN KEY `fk_serie_genero_genero`');
        $this->addSql('ALTER TABLE serie_genero DROP FOREIGN KEY `fk_serie_genero_serie`');
        $this->addSql('ALTER TABLE serie_genero MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE serie_genero DROP id, CHANGE serie_id serie_id INT NOT NULL, CHANGE genero_id genero_id INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (serie_id, genero_id)');
        $this->addSql('ALTER TABLE serie_genero ADD CONSTRAINT FK_57AAD353D94388BD FOREIGN KEY (serie_id) REFERENCES CN_API.serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_genero ADD CONSTRAINT FK_57AAD353BCE7B795 FOREIGN KEY (genero_id) REFERENCES CN_API.genero (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_genero RENAME INDEX fk_serie_genero_serie TO IDX_57AAD353D94388BD');
        $this->addSql('ALTER TABLE serie_genero RENAME INDEX fk_serie_genero_genero TO IDX_57AAD353BCE7B795');
        $this->addSql('ALTER TABLE serie_categoria MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE serie_categoria DROP id, CHANGE id_serie id_serie INT NOT NULL, CHANGE id_categoria id_categoria INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id_serie, id_categoria)');
        $this->addSql('ALTER TABLE serie_categoria RENAME INDEX fk_serie_categoria_serie TO IDX_665A2C1C44BFD204');
        $this->addSql('ALTER TABLE serie_categoria RENAME INDEX fk_serie_categoria_categoria TO IDX_665A2C1CCE25AE0A');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(225) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, descripcion VARCHAR(225) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, imagen VARCHAR(225) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE genero (id INT AUTO_INCREMENT NOT NULL, id_api INT DEFAULT NULL, name VARCHAR(225) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ranking (id INT AUTO_INCREMENT NOT NULL, id_usurio INT DEFAULT NULL, id_categoria INT DEFAULT NULL, INDEX fk_ranking_categoria (id_categoria), INDEX fk_ranking_usuario (id_usurio), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ranking_serie (id INT AUTO_INCREMENT NOT NULL, id_serie INT DEFAULT NULL, id_ranking INT DEFAULT NULL, position INT DEFAULT NULL, INDEX fk_ranking_serie_ranking (id_ranking), INDEX fk_ranking_serie_serie (id_serie), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE serie (id INT AUTO_INCREMENT NOT NULL, original_name VARCHAR(225) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, overview TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, popularity FLOAT DEFAULT NULL, poster_path VARCHAR(500) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, first_air_date VARCHAR(225) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, name VARCHAR(225) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, vote_average FLOAT DEFAULT NULL, vote_count INT DEFAULT NULL, idApi INT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(225) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, correo VARCHAR(225) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, contrasena VARCHAR(500) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, imagen VARCHAR(225) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, rol VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE valoracion (id INT AUTO_INCREMENT NOT NULL, id_usuario INT DEFAULT NULL, id_serie INT DEFAULT NULL, nota FLOAT DEFAULT NULL, fecha DATE DEFAULT NULL, comentario TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, INDEX fk_valoracion_serie (id_serie), INDEX fk_valoracion_usuario (id_usuario), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ranking ADD CONSTRAINT `fk_ranking_categoria` FOREIGN KEY (id_categoria) REFERENCES categoria (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ranking ADD CONSTRAINT `fk_ranking_usuario` FOREIGN KEY (id_usurio) REFERENCES usuario (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ranking_serie ADD CONSTRAINT `fk_ranking_serie_ranking` FOREIGN KEY (id_ranking) REFERENCES ranking (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ranking_serie ADD CONSTRAINT `fk_ranking_serie_serie` FOREIGN KEY (id_serie) REFERENCES serie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE valoracion ADD CONSTRAINT `fk_valoracion_serie` FOREIGN KEY (id_serie) REFERENCES serie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE valoracion ADD CONSTRAINT `fk_valoracion_usuario` FOREIGN KEY (id_usuario) REFERENCES usuario (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE CN_API.ranking DROP FOREIGN KEY FK_C82C907ACE25AE0A');
        $this->addSql('ALTER TABLE CN_API.ranking DROP FOREIGN KEY FK_C82C907AFCF8192D');
        $this->addSql('ALTER TABLE CN_API.ranking_serie DROP FOREIGN KEY FK_2EE5A16144BFD204');
        $this->addSql('ALTER TABLE CN_API.ranking_serie DROP FOREIGN KEY FK_2EE5A1615E2590A0');
        $this->addSql('ALTER TABLE CN_API.valoracion DROP FOREIGN KEY FK_317568F744BFD204');
        $this->addSql('ALTER TABLE CN_API.valoracion DROP FOREIGN KEY FK_317568F7FCF8192D');
        $this->addSql('DROP TABLE CN_API.categoria');
        $this->addSql('DROP TABLE CN_API.genero');
        $this->addSql('DROP TABLE CN_API.ranking');
        $this->addSql('DROP TABLE CN_API.ranking_serie');
        $this->addSql('DROP TABLE CN_API.serie');
        $this->addSql('DROP TABLE CN_API.usuario');
        $this->addSql('DROP TABLE CN_API.valoracion');
        $this->addSql('ALTER TABLE serie_categoria ADD id INT AUTO_INCREMENT NOT NULL, CHANGE id_serie id_serie INT DEFAULT NULL, CHANGE id_categoria id_categoria INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE serie_categoria RENAME INDEX idx_665a2c1cce25ae0a TO fk_serie_categoria_categoria');
        $this->addSql('ALTER TABLE serie_categoria RENAME INDEX idx_665a2c1c44bfd204 TO fk_serie_categoria_serie');
        $this->addSql('ALTER TABLE serie_genero DROP FOREIGN KEY FK_57AAD353D94388BD');
        $this->addSql('ALTER TABLE serie_genero DROP FOREIGN KEY FK_57AAD353BCE7B795');
        $this->addSql('ALTER TABLE serie_genero ADD id INT AUTO_INCREMENT NOT NULL, CHANGE serie_id serie_id INT DEFAULT NULL, CHANGE genero_id genero_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE serie_genero ADD CONSTRAINT `fk_serie_genero_genero` FOREIGN KEY (genero_id) REFERENCES genero (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE serie_genero ADD CONSTRAINT `fk_serie_genero_serie` FOREIGN KEY (serie_id) REFERENCES serie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE serie_genero RENAME INDEX idx_57aad353bce7b795 TO fk_serie_genero_genero');
        $this->addSql('ALTER TABLE serie_genero RENAME INDEX idx_57aad353d94388bd TO fk_serie_genero_serie');
    }
}
