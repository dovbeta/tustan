<?php
    function translitIt_to_eng($str){
		//$str = iconv("utf-8","windows-1251",$str);
        $tr['А'] = 'A'; $tr['Б'] = 'B'; $tr['В'] = 'V'; $tr['Г'] = 'H'; 
		$tr['Д'] = 'D'; $tr['Е'] = 'E'; $tr['Є'] = 'IE'; $tr['Ж'] = 'ZH'; 
		$tr['З'] = 'Z'; $tr['И'] = 'Y'; $tr['І'] = 'I'; $tr['Ї'] = 'YI'; 
		$tr['Й'] = 'Y'; $tr['К'] = 'K'; $tr['Л'] = 'L'; $tr['М'] = 'M'; 
		$tr['Н'] = 'N'; $tr['О'] = 'O'; $tr['П'] = 'P'; $tr['Р'] = 'R'; 
		$tr['С'] = 'S'; $tr['Т'] = 'T'; $tr['У'] = 'U'; $tr['Ф'] = 'F'; 
		$tr['Х'] = 'KH'; $tr['Ц'] = 'TS'; $tr['Ч'] = 'CH'; $tr['Ш'] = 'SH'; 
		$tr['Щ'] = 'SHCH'; $tr['Ь'] = '-'; $tr['Ю'] = 'YU'; $tr['Я'] = 'YA'; 
		$tr['а'] = 'a'; $tr['б'] = 'b'; $tr['в'] = 'v'; $tr['г'] = 'h'; 
		$tr['д'] = 'd'; $tr['е'] = 'e'; $tr['є'] = 'ie'; $tr['ж'] = 'zh'; 
		$tr['з'] = 'z'; $tr['и'] = 'y'; $tr['і'] = 'i'; $tr['ї'] = 'yi'; 
		$tr['й'] = 'y'; $tr['к'] = 'k'; $tr['л'] = 'l'; $tr['м'] = 'm'; 
		$tr['н'] = 'n'; $tr['о'] = 'o'; $tr['п'] = 'p'; $tr['р'] = 'r'; 
		$tr['с'] = 's'; $tr['т'] = 't'; $tr['у'] = 'u'; $tr['ф'] = 'f'; 
		$tr['х'] = 'kh'; $tr['ц'] = 'ts'; $tr['ч'] = 'ch'; $tr['ш'] = 'sh'; 
		$tr['щ'] = 'shch'; $tr['ь'] = 'lo'; $tr['ю'] = 'yu'; $tr['я'] = 'ya'; $tr[' '] = '_';
		$tr['ы'] = 'loi';$tr['э'] = 'ne';$tr['ъ'] = 'tlo';
        return strtr($str,$tr);
    }

    function translitIt_to_ukr($str){
        $tr['A'] ="А"; $tr['B'] ="Б"; $tr['V'] ="В"; $tr['H'] ="Г";
        $tr['D'] ="Д"; $tr['E'] ="Е"; $tr['IE'] ="Є"; $tr['ZH'] ="Ж";
        $tr['Z'] ="З"; $tr['Y'] ="И"; $tr['I'] ="І"; $tr['YI'] ="Ї";
        $tr['Y'] ="Й"; $tr['K'] ="К"; $tr['L'] ="Л"; $tr['M'] ="М"; $tr['N'] ="Н";
        $tr['O'] ="О"; $tr['P'] ="П"; $tr['R'] ="Р"; $tr['S'] ="С"; $tr['T'] ="Т";
        $tr['U'] ="У"; $tr['F'] ="Ф"; $tr['KH'] ="Х"; $tr['TS'] ="Ц"; $tr['CH'] ="Ч";
        $tr['SH'] ="Ш"; $tr['SHCH'] ="Щ"; $tr['-'] ="Ь"; $tr['YU'] ="Ю"; $tr['YA'] ="Я";
        $tr['a'] ="а"; $tr['b'] ="б"; $tr['v'] ="в"; $tr['h'] ="г";
        $tr['d'] ="д"; $tr['e'] ="е"; $tr['ie'] ="є"; $tr['zh'] ="ж";
        $tr['z'] ="з"; $tr['y'] ="и"; $tr['i'] ="і"; $tr['yi'] ="ї";
        $tr['y'] ="й"; $tr['k'] ="к"; $tr['l'] ="л"; $tr['m'] ="м"; $tr['n'] ="н";
        $tr['o'] ="о"; $tr['p'] ="п"; $tr['r'] ="р"; $tr['s'] ="с"; $tr['t'] ="т";
        $tr['u'] ="у"; $tr['f'] ="ф"; $tr['kh'] ="х"; $tr['ts'] ="ц"; $tr['ch'] ="ч";
        $tr['sh'] ="ш"; $tr['shch'] ="щ"; $tr['lo'] ="ь"; $tr['yu'] ="ю"; $tr['ya'] ="я"; 
		$tr['_'] =" "; $tr['loi'] ="ы"; $tr['ne'] ="э"; $tr['tlo'] ="ъ";
        return strtr($str,$tr);
    }

    function encode($str,$code){
        $s = mb_detect_encoding($str);
        $str = iconv($s, $code, $str);//'CP1251//TRANSLIT'
        return $str;
    }
	
	function to_sql_date($date){
		$y = substr($date,6,4);
		$m = substr($date,3,2);
		$d = substr($date,0,2);
		return $y."-".$m."-".$d;
	}
	
	
?>