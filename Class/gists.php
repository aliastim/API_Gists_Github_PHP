<?php
/**
 * Created by PhpStorm.
 * User: timotheecorrado
 * Date: 2019-03-10
 * Time: 10:35
 */

class Gists {

    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getGists(): ?array
    {
        $curl = curl_init("https://api.github.com/users/$this->apiKey/gists");
        curl_setopt_array($curl, [
            CURLOPT_USERAGENT => 'aliastim',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 1
        ]);

        $data = curl_exec($curl);
            if ($data === false) {
                return var_dump(curl_error($curl));
            }
        $results = [];
        $data = json_decode($data, true);
        foreach ($data as $value) {
            //var_dump($value);
            $results[] = [
                'url' => $value['html_url'],
                'name' =>
                    preg_replace
                    (
                        "#[^a-zA-Zéèàê!']#", " ",
                        substr
                        (
                            implode(
                                array_keys($value['files'])
                                    ),
                            0, -3
                        )
                    ),
                'created_at' => substr($value['created_at'], 0, -10),
                'updated_at' => substr($value['updated_at'], 0, -10)

            ];
        }
        return $results;

    }
}