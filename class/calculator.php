<?php 
    class Calculator{
        private $romanDigits = ["M"=>1000, "D"=>500, "C" => 100, "L"=>50,"X"=>10, "V"=>5,"I"=>1];
        private int $number;
        private int $temp_number;
        private $result = '';
        
        public function __construct(int $number){
            $this->temp_number = $this->number = $number;
        }

        public function calculate():string{
            $count = 0;
            foreach($this->romanDigits as $key=>$item){
                if($this->temp_number < $item)continue;

                $count = floor($this->temp_number / $item);
                $this->temp_number = $this->temp_number - ($count * $item);
                
                for($i = 0 ; $i < $count; $i++){
                    $result .= $key;
                }
            }

            return $result;
        }
    }
?>
