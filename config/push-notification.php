<?php

return array(

    'appNameIOS'     => array(
        'environment' =>'development',
        'certificate' =>'/path/to/certificate.pem',
        'passPhrase'  =>'password',
        'service'     =>'apns'
    ),
    'appNameAndroid' => array(
        'environment' =>'production',
        'apiKey'      =>'AAAAP-7SOA8:APA91bFskoDrufDXWC67vwWUkK7Cg7vMLDy_XWnwxDvoMMQfOJ6NvwKjb2BDn4jymbPwOJXfDUVKURcSwsS6BlEdvGJLB8qMqV9PmaODY7as4N5x3pU_Hv5pW4AyrJWIY2vvLyWq2kEB',
        'service'     =>'gcm'
    )

);