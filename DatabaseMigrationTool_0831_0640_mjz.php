<?php
// 代码生成时间: 2025-08-31 06:40:30
use Cake\Console\ConsoleOptionParser;
use Cake\Console\Shell;
use Cake\Database\Connection;
use Cake\Migrations\Migrations;

class DatabaseMigrationTool extends Shell
{
    protected $connectionName = 'default';
    protected $tableName = 'migrations';
    protected $migrationsPath = 'config/migrations';

    public function getOptionParser(): ConsoleOptionParser
    {
        $parser = new ConsoleOptionParser(
            'DatabaseMigrationTool'
        );
        $parser->setDescription('A simple database migration tool.');
        $parser->addOption('plugin', [
            'short' => 'p',
            'help' => 'The plugin to use.',
        ]);
        $parser->addOption('connection', [
            'short' => 'c',
            'default' => $this->connectionName,
            'help' => 'The connection to use.',
        ]);
        $parser->addOption('table', [
            'short' => 't',
            'default', $this->tableName,
            'help' => 'The table to use for keeping track of migrations.',
        ]);
        $parser->addOption('path', [
            'short' => 'q',
            'default' => $this->migrationsPath,
            'help' => 'The path to the migration files.',
        ]);
        return $parser;
    }

    public function main(): void
    {
        if ($this->param('help')) {
            $this->out($this->OptionParser->help());
            return;
        }

        $this->connectionName = $this->param('connection');
        $connection = Connection::get($this->connectionName);
        $this->tableName = $this->param('table');
        $migrationsPath = $this->param('path');

        try {
            // Initialize the migrations instance
            $migrations = new Migrations($connection, $this->tableName, $migrationsPath);

            // Apply all outstanding migrations
            $migrations->migrate();
            $this->out("All migrations applied successfully.\
");

        } catch (Exception $e) {
            // Handle any exceptions that occur during migration
            $this->err("There was an error applying migrations: " . $e->getMessage());
            $this->abort();
        }
    }
}
