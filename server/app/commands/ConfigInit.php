<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ConfigInit extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'config:init';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Initialize the excel config';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->loadBasicConfig();
	}

	private function loadBasicConfig()
	{
		MongoBasicConfig::truncate();

		$this->info('load basic_config.xls...');
		$file = __DIR__ . '/../../excel/basic_config.xls';

		$objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format
		$objPHPExcel = $objReader->load($file);
		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow(); // 取得总行数
		$highestColumn = $sheet->getHighestColumn(); // 取得总列数

		$planet = $sheet->getCell("B1")->getValue();
		$starfieldMaxCount = $sheet->getCell("B2")->getValue();
		$constellationMaxCount = $sheet->getCell("B3")->getValue();
		$galaxyMaxCount = $sheet->getCell("B4")->getValue();
		$indexMaxCount = $sheet->getCell("B5")->getValue();
		$mongoBasicConfig = new MongoBasicConfig;
		$mongoBasicConfig->planet = $planet;
		$mongoBasicConfig->starfieldMaxCount = $starfieldMaxCount;
		$mongoBasicConfig->constellationMaxCount = $constellationMaxCount;
		$mongoBasicConfig->galaxyMaxCount = $galaxyMaxCount;
		$mongoBasicConfig->indexMaxCount = $indexMaxCount;
		$mongoBasicConfig->save();
		$this->info('done basic_config.xls');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	// protected function getArguments()
	// {
	// 	return array(
	// 		array('example', InputArgument::REQUIRED, 'An example argument.'),
	// 	);
	// }

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	// protected function getOptions()
	// {
	// 	return array(
	// 		array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
	// 	);
	// }

}
