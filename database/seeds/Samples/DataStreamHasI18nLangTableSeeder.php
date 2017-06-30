<?php

use App\Models\DataStreamHasI18nLang;
use Illuminate\Database\Seeder;

class DataStreamHasI18nLangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    // Mickey Mouse Sample Project - fr
	    DataStreamHasI18nLang::create([
		    'data_stream_id'    => '605d712c-1934-11e7-93ae-92361f002671',
		    'i18n_lang_id'      => 'fr_FR',
	    ]);

	    // Mickey Mouse Sample Project - en
	    DataStreamHasI18nLang::create([
		    'data_stream_id'    => '605d712c-1934-11e7-93ae-92361f002671',
		    'i18n_lang_id'      => 'en_US',
	    ]);
    }
}