const bd = require("../config/db");
const bwipjs = require('bwip-js');

exports.createEquipo = (req, res) => {
    const { marca, descripcion, usuario_id, novedad } = req.body;

    bwipjs.toBuffer({
        bcid: 'code128',
        text: usuario_id + marca,
        scale: 3, 
        height: 10,
        includetext: true,
        textxalign: 'center',
    }, (err, png) => {
        if (err) {
            return res.status(500).json({ error: "Error generando el código de barras" });
        }

        const codigoBarras = png.toString('base64');

        const query = `INSERT INTO equipo (marca, descripcion, codigoBarras, usuario_id, novedad) 
                       VALUES (?, ?, ?, ?, ?)`;

        bd.query(query, [marca, descripcion, codigoBarras, usuario_id, novedad], (err, results) => {
            if (err) {
                return res.status(500).json({ error: "Fallo al registrar el equipo" });
            }
            res.status(201).json({ message: "Equipo registrado" });
        });
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
    const { marca, descripcion, usuario_id, novedad } = req.body;
    const query = `UPDATE equipo SET marca = ?, descripcion = ?, usuario_id = ?, novedad = ? WHERE codigoBarras = ?`;

    bd.query(query, [marca, descripcion, usuario_id, novedad, codigoBarras], (err, results) => {
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

    const query = `INSERT INTO movimiento (equipo_id, tipo) 
                   SELECT id_equipo, ? FROM equipo WHERE codigoBarras = ?`;

    bd.query(query, [tipo, codigoBarras], (err, results) => {
        if (err) {
            return res.status(500).json({ error: "Fallo al registrar el ingreso/salida" });
        }
        res.status(201).json({ message: `Movimiento de ${tipo} registrado exitosamente` });
    });
};
