<?php	
	//Required classes
	$iOS = iOS::getInstance();
	$html = Html::getInstance();
	$beanstalk = Beanstalk::getInstance();

	//Get repositories
	$repositories = $beanstalk->getRepositories();

	//Get feed & create array
	$commits = array();
	$feed = $beanstalk->getFeed($repositories);

	//Give index to array
	if(isset($feed['revision_cache']))  {
		$feed = array('0' => $feed);
	}
	
	foreach($feed as $item) {
		$item = $item['revision_cache'];	
		if(strpos($item['message'], '[hide]') !== false) continue;

		$commit_info = array(
			'message' => $item['message'],
			'gravatar' => $html->getGravatar($item['email']),
			'changed_files' => count($item['changed_files']),
			'repo_id' => $item['repository_id'],
			'repository' => $repositories[$item['repository_id']],
			'revision' => $item['revision'],
			'time' => $html->time_elapsed_string(strtotime($item['time'])) . " ago"
		);

		if(!isset($item['hash_id'])) {
			$commit_info['hash'] = $item['revision'];
		} else {
			$commit_info['hash'] = $item['hash_id'];
		}


		$commits[] = $commit_info;
	}

	if($commits == null) {
		$error->trigger('No commit feed found. Check the config file for account settings OR commit something.'); 
	} 