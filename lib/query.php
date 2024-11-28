<?php 

    require_once 'conexaobd.php';

    class query {
        
        private $sql;
        private $registros;
        private $connection;
        private $queryResource;

        public function __construct($oConn) {
            $this->registros = 0;
            $this->connection = $oConn;
        }

        public function open() {
            $this->queryResource = pg_query($this->connection->getInternalConnection(), $this->sql);
            if($this->queryResource) {
                $this->registros = pg_num_rows($this->queryResource);
                return true;
            }
            return false;
        }

        public function getAll() {
            $result = Array();
            while($row = $this->getNextRow()) {
                array_push($result, $row);
            }
            return $result;
        }

        public function getNextRow() {
            $row = pg_fetch_assoc($this->queryResource);
            if($row) {
                return $row;
            }
            return false;
        }

        public function update($sTabela, $aColunas, $aValores, $sWhere) {
            if (count($aColunas) !== count($aValores)) {
                throw new Exception("O número de colunas e valores deve ser igual.");
            }
            $setPart = [];
            foreach ($aColunas as $index => $coluna) {
                $setPart[] = "$coluna = $" . ($index + 1); 
            }
            $setClause = implode(", ", $setPart);
            $sql = "UPDATE $sTabela SET $setClause WHERE $sWhere";
            $result = pg_query_params(
                $this->connection->getInternalConnection(),
                $sql,
                $aValores
            );
            if($result === false) {
                throw new Exception("Erro ao executar a consulta: " . pg_last_error($this->connection->getInternalConnection()));
            }
        
            return $result;
        }

        // public function update($sTabela, $aColunas, $aValores, $sWhere) {
        //     for($iCampo = 1; $iCampo <= count($aColunas); $iCampo++) {
        //         $varCol = "$".$iCampo;
        //     }
        //     $result = pg_query_params($this->connection->getInternalConnection(), 
        //                               "UPDATE " . $sTabela . " SET " . $aColunas . " = " . $varCol . " WHERE " . $sWhere, 
        //                               $aValores);
        //     return $result;
        // }

        public function insert($sTabela, $aColunas, $aValores) {
            $placeholders = array_map(fn($index) => "$" . ($index + 1), array_keys($aValores));
            $sColunas = implode(", ", $aColunas);
            $sValores = implode(", ", $placeholders);
            $result = pg_query_params(
                $this->connection->getInternalConnection(), 
                "INSERT INTO $sTabela ($sColunas) VALUES ($sValores) RETURNING *",
                $aValores);
            return pg_fetch_assoc($result);
        }

        public function delete($sTabela, $sWhere) {
            //TODO implementar método de delete
        }

        public function getRegistros() {
            return $this->registros;
        }

        public function setSql($sSql) {
            $this->sql = $sSql;
        }

    }
?>