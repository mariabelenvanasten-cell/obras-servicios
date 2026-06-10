public function create($data){

    $sql = "INSERT INTO ordenes
    (
        descripcion,
        empresa,
        area,
        ciudad
    )
    VALUES (?, ?, ?, ?)";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([

        $data['descripcion'],
        $data['empresa'],
        $data['area'],
        $data['ciudad']
    ]);
}