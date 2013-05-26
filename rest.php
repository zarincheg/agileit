<?php
echo json_encode(['author' => 'Ivan Buvan',
				  'date' => '25/05/2013',
				  'text' => 'Pages fetched with POST are never cached, so the cache and ifModified options in jQuery.ajaxSetup() have no effect on these requests.'
				 ]);