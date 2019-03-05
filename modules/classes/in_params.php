<?


class InParams {
	
	function Param($guid){
		//print $guid;
		
		switch ($guid) {
			case '{6609B608-840C-41D7-94D5-0244B64A3DD7}':
				return 'Остаток по лимиту';
				break;
			case '{A6F9570C-6E41-4B41-AD2C-491EA688B875}':
				return 'Франшиза';
				break;
			case '{8A26697C-9B55-43F3-A0DA-D86392E318BD}':
				return 'Франшиза на медикаменты';
				break;
			case '{7E7323A3-3006-4F47-AC03-01232391604E}':
				return 'Франшиза на лабораторные услуги';
				break;
			case '{48F9D947-FF88-42DE-8539-631025345E6B}':
				return 'Хирургия';
				break;
			case '{2573CE7E-021E-4824-993E-2D7D8E42C7AA}':
				return 'Терапия';
				break;
			case '{A1803C9F-1968-4677-A025-08CEB548B2A6}':
				return 'Снятие ЗО';
				break;
			case '{12FD94A9-3B9A-4B7D-BCE5-288AC755A033}':
				return 'Протезирование';
				break;

		}
	}

}

?>