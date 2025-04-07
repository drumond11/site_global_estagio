<?php
namespace Simulador\Preco;

class Valor{
    public static int $MODO_TERRENO_TERRENO = 0;
    public static int $MODO_TERRENO_BRUTO = 1;
    public static int $MODO_TERRENO_TOTAL = 2;

    public float $terreno;
    public float $bruto;
    public array $estado;
    public array $caracteristicas;

    public array $quantidades = [];

    public function __construct(array $path = null, $valores){
        $this->setValues($valores);
        if(!empty($path))            
            foreach($path as $val){
                if(!isset($valores['localizacoes']) || !isset($valores['localizacoes'][$val])) break;
                $valores = $valores['localizacoes'][$val];
                $this->setValues($valores);
            }
    }

    public function setEstado(string $estado){
        isset($this->estado[$estado]) && $this->quantidades['estado'] = $estado;
        return $this;
    }

    public function setTerreno($m2, bool $bruto = false){
        $var = $bruto?'bruto':'terreno';
        $this->quantidades[$var] = $m2;
        return $this;
    }

    public function setCaracteristica(string $caracteristica, int $quantidade){
        empty($this->quantidades['caracteristicas']) && $this->quantidades['caracteristicas'] = [];
        isset($this->caracteristicas[$caracteristica]) && $this->quantidades['caracteristicas'][$caracteristica] = $quantidade;
    }

    public function calcularCaracteristicas(){
        if(empty($this->quantidades['caracteristicas']))
            return 0;
        $total = 0;
        foreach($this->quantidades['caracteristicas'] as $k => $carac)
            $total += $this->caracteristicas[$k]*$carac;
        return $total;
    }

    public function calcularEstado(){
        return isset($this->quantidades['estado']) && isset($this->estado)?$this->estado[$this->quantidades['estado']]:0;
    }

    public function calcularTerreno(int $modo = 2){
        switch($modo){
            case Valor::$MODO_TERRENO_BRUTO:
                return $this->privCalcularTerreno(true);
            case Valor::$MODO_TERRENO_TERRENO:
                return $this->privCalcularTerreno(false);
            default:
            case Valor::$MODO_TERRENO_TOTAL:
                return $this->privCalcularTerreno(true)+$this->privCalcularTerreno(false);
        }
    }

    public function calcularTotal(){
        return $this->calcularTerreno(Valor::$MODO_TERRENO_TOTAL)+$this->calcularEstado()+$this->calcularCaracteristicas();
    }

    private function privCalcularTerreno(bool $bruto = false){
        $var = $bruto?'bruto':'terreno';
        $quant = $this->quantidades[$var] ?? 0;
        if(empty($quant))
            $quant = 0;        
        return $quant*$this->{$var};
    }

    private function setValues(array $values){
        isset($values['terreno']) && $this->terreno = $values['terreno'];
        isset($values['bruto']) && $this->bruto = $values['bruto'];
        isset($values['estado']) && $this->estado = $values['estado'];
        isset($values['caracteristicas']) && $this->caracteristicas = $values['caracteristicas'];
    }
}