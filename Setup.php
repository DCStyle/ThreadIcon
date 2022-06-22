<?php

namespace DC\ThreadIcon;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;

use XF\Db\Schema\Alter;
use XF\Db\Schema\Create;

class Setup extends AbstractSetup
{
	use StepRunnerInstallTrait;
	use StepRunnerUpgradeTrait;
	use StepRunnerUninstallTrait;

	// ################################ INSTALLATION ####################

	public function installStep1()
	{
		$sm = $this->schemaManager();

		foreach ($this->getTables() AS $tableName => $closure)
		{
			$sm->createTable($tableName, $closure);
		}
	}

	public function installStep2()
    {
        $sm = $this->schemaManager();

        foreach ($this->getAlterTables() AS $tableName => $closure)
        {
            $sm->alterTable($tableName, $closure[0]);
        }
    }

	// ################################ UNINSTALL #########################

	public function uninstallStep1()
	{
		$sm = $this->schemaManager();

		foreach (array_keys($this->getTables()) AS $tableName)
		{
			$sm->dropTable($tableName);
		}
	}

	public function uninstallStep2()
    {
        $sm = $this->schemaManager();

        foreach ($this->getAlterTables() AS $tableName => $closure)
        {
            $sm->alterTable($tableName, $closure[1]);
        }
    }

	// ############################# TABLE / DATA DEFINITIONS ##############################

	protected function getTables()
	{
		$tables = [];

		$tables['xf_dcThreadIcon_icon'] = function(Create $table)
		{
			$table->checkExists(true);
			$table->addColumn('thread_id', 'int', 10);
			$table->addColumn('icon', 'varchar', 100);
			$table->addColumn('position', 'enum')->values(['before', 'after'])->setDefault('before');
			$table->addPrimaryKey('thread_id');
		};

        return $tables;
    }

	protected function getAlterTables()
    {
        $tables = [];

		return $tables;
	}
}