const bd = require("../config/db");

exports.createEquipo = (req, res) => {
    const { nombrePropietario, tipoIdentificacion, identificacion, equipo, descripcion, codigoBarras } = req.body;
    const query = `INSERT INTO equipo (nombrePropietario, tipoIdentificacion, identificacion, equipo, descripcion, codigoBarras) VALUES (?, ?, ?, ?, ?, ?)`;

    bd.query(query, [nombrePropietario, tipoIdentificacion, identificacion, equipo, descripcion, codigoBarras], (err, results) => {
        if (err) {
            return res.status(500).json({ error: "Fallo al agregar el equipo" });
        }
        res.status(201).json({ message: "Equipo registrado" });
    });
};

exports.getEquipo = (req, res) => {
    const { codigoBarras } = req.params;
    const query = `SELECT * FROM equipo WHERE codigoBarras = ?`;

    bd.query(query, [codigoBarras], (err, results) => {
        if (err) {
            return res.status(500).json({ error: "Fallo al obtener el equipo" });
        }
        if (!results[0]) {
            return res.status(404).json({ error: "Equipo no encontrado" });
        }
        res.json(results[0]);
    });
};

exports.updateEquipo = (req, res) => {
    const { codigoBarras } = req.params;
    const { nombrePropietario, tipoIdentificacion, identificacion, equipo, descripcion } = req.body;
    const query = `UPDATE equipo SET nombrePropietario = ?, tipoIdentificacion = ?, identificacion = ?, equipo = ?, descripcion = ? WHERE codigoBarras = ?`;

    bd.query(query, [nombrePropietario, tipoIdentificacion, identificacion, equipo, descripcion, codigoBarras], (err, results) => {
        if (err) {
            return res.status(500).json({ error: "Fallo al actualizar el equipo" });
        }
        if (!results.affectedRows) {
            return res.status(404).json({ error: "Equipo no encontrado" });
        }
        res.json({ message: "Equipo actualizado" });
    });
};

exports.ingresoYSalida = (req, res) => {
    const { codigoBarras } = req.params;
    const { tipo } = req.body;

    const query = `INSERT INTO movimientos (codigoBarras, tipo) VALUES (?, ?)`;

    bd.query(query, [codigoBarras, tipo], (err, results) => {
        if (err) {
            return res.status(500).json({ error: "Fallo al registrar el ingreso/salida" });
        }
        res.status(201).json({ message: `Movimiento de ${tipo} registrado éxitosamente` });
    });
};
