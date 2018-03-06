/rest/v10"; $username = "admin"; $password = "password"; //Login - POST /oauth2/token $url = $instance_url . "/oauth2/token"; $oauth2_token_arguments = array( "grant_type" => "password", //client id - default is sugar. //It is recommended to create your own in Admin > OAuth Keys "client_id" => "sugar", "client_secret" => "", "username" => $username, "password" => $password, //platform type - default is base. //It is recommend to change the platform to a custom name such as "custom_api" to avoid authentication conflicts. "platform" => "custom_api" ); $curl_request = curl_init($url); curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0); curl_setopt($curl_request, CURLOPT_HEADER, false); curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0); curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1); curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0); curl_setopt($curl_request, CURLOPT_HTTPHEADER, array( "Content-Type: application/json" )); //convert arguments to json $json_arguments = json_encode($oauth2_token_arguments); curl_setopt($curl_request, CURLOPT_POSTFIELDS, $json_arguments); //execute request $curl_response = curl_exec($curl_request); //decode oauth2 response to get token $oauth2_token_response_obj = json_decode($curl_response); $oauth_token = $oauth2_token_response_obj->access_token; curl_close($curl_request); //Create Records - POST / $url = $instance_url . "/Accounts"; //Set up the Record details $record = array( 'name' => 'Test Record', 'email1' => 'test@sugar.com' ); $curl_request = curl_init($url); curl_setopt($curl_request, CURLOPT_POST, 1); curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0); curl_setopt($curl_request, CURLOPT_HEADER, false); curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0); curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1); curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0); curl_setopt($curl_request, CURLOPT_HTTPHEADER, array( "Content-Type: application/json", "oauth-token: {$oauth_token}" )); //convert arguments to json $json_arguments = json_encode($record); echo "
JSON Request

".$json_arguments."

"; curl_setopt($curl_request, CURLOPT_POSTFIELDS, $json_arguments); //execute request $curl_response = curl_exec($curl_request); echo "
JSON Response

".$curl_response."

"; //decode json $createdRecord = json_decode($curl_response); //display the created record echo "Created Record: ". $createdRecord->id; curl_close($curl_request); $id = $createdRecord->id; //Get Record - GET //:record $url = $instance_url . "/Accounts/$id"; //Set up the Record details $data = array( 'fields' => 'name,email1,industry' ); $url = $url."?".http_build_query($data); $curl_request = curl_init($url); curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0); curl_setopt($curl_request, CURLOPT_HEADER, false); curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0); curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1); curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0); curl_setopt($curl_request, CURLOPT_HTTPHEADER, array( "Content-Type: application/json", "oauth-token: {$oauth_token}" )); //execute request $curl_response = curl_exec($curl_request); echo "
JSON Response

".$curl_response."

"; //decode json $record = json_decode($curl_response); //display the created record echo "

".print_r($record,true)."

"; curl_close($curl_request); $id = $record->id; //Update Record - PUT //:record $url = $instance_url . "/Accounts/$id"; //Set up the Record details $record->name = 'Updated Test Record'; $curl_request = curl_init($url); curl_setopt($curl_request, CURLOPT_CUSTOMREQUEST, "PUT"); curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0); curl_setopt($curl_request, CURLOPT_HEADER, false); curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0); curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1); curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0); curl_setopt($curl_request, CURLOPT_HTTPHEADER, array( "Content-Type: application/json", "oauth-token: {$oauth_token}" )); //convert arguments to json $json_arguments = json_encode($record); echo "
JSON Request

".$json_arguments."

"; curl_setopt($curl_request, CURLOPT_POSTFIELDS, $json_arguments); //execute request $curl_response = curl_exec($curl_request); echo "
JSON Response

".$curl_response."


"; //decode json $updatedRecord = json_decode($curl_response); //display the created record echo "Updated Record Name:".$updatedRecord->name; curl_close($curl_request); $id = $updatedRecord->id; //Update Record - PUT //:record $url = $instance_url . "/Accounts/$id"; $curl_request = curl_init($url); curl_setopt($curl_request, CURLOPT_CUSTOMREQUEST, "DELETE"); curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0); curl_setopt($curl_request, CURLOPT_HEADER, false); curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0); curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1); curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0); curl_setopt($curl_request, CURLOPT_HTTPHEADER, array( "Content-Type: application/json", "oauth-token: {$oauth_token}" )); //execute request $curl_response = curl_exec($curl_request); echo "
JSON Response

".$curl_response."


"; //decode json $deletedRecord = json_decode($curl_response); //display the created record echo "Deleted Record:".$deletedRecord->id;