const Equipo = require('../models/Equipo.js')
const Movimiento = require('../models/Movimiento.js')
const path = require('path')
const { generarCodBarras } = require('../utils/generadorCodBarras.js')

exports.createEquipo = async (req, res) => {
    try {
        const { marca, descripcion, usuario_id } = req.body

        const textoCodBarras = `${marca}-${usuario.documento}`

        const equipoExistente = await Equipo.findOne({ where: { codigoBarras: textoCodBarras } });
        if (equipoExistente) {
            return res.status(400).json({ message: 'El código de barras ya existe para otro equipo' });
        }

        const nuevoEquipo = await Equipo.create({
            marca,
            descripcion,
            codigoBarras: textoCodBarras,
            usuario_id,
            novedad: 'Recien creado'
        })

        const rutaCodBarras = path.join(__dirname, `../codBarras/${textoCodBarras}.png`)
        await generarCodBarras(textoCodBarras, rutaCodBarras)

        res.status(201).json({
            message: 'Equipo registrado',
            equipo: nuevoEquipo,
            codigoBarras: `/codBarras/${textoCodBarras}.png`
        })
    } catch (err) {
        console.error(err)
        res.status(500).send('Fallo al registrar equipo')
    }
};


exports.getEquipo = async (req, res) => {
    try {
        const { codigoBarras } = req.params
        const equipo = await Equipo.findOne({ where: { codigoBarras } })
        if (!equipo) {
            return res.status(404).send('Equipo no encontrado')
        }
        res.json(equipo)
    } catch (err) {
        console.error(err)
        res.status(500).send('Fallo al obtener equipo')
    }
};

exports.updateEquipo = async (req, res) => {
    try {
        const { codigoBarras } = req.params
        const { marca, desripcion } = req.body
        const actualizar = await Equipo.update({ marca, descripcion }, { where: { codigoBarras } })
        if (!actualizar) {
            return res.status(404).send('Equipo no encontrado')
        }
        res.send('Actualizado')
    } catch (err) {
        console.error(err)
        res.status(500).send('Fallo al actualizar equipo')
    }
};

exports.ingresoYSalida = async (req, res) => {
    try {
        const { codigoBarras } = req.params;

        const equipo = await Equipo.findOne({ where: { codigoBarras } });
        if (!equipo) {
            return res.status(404).send('Equipo no encontrado');
        }

        const ultimoMovimiento = await Movimiento.findOne({
            where: { equipo_id: equipo.id_equipo },
            order: [['id_movimiento', 'DESC']]
        });

        const nuevoTipo = ultimoMovimiento ? (ultimoMovimiento.tipo === 0 ? 1 : 0) : 0;

        const nuevoMovimiento = await Movimiento.create({
            equipo_id: equipo.id_equipo,
            tipo: nuevoTipo
        });

        res.status(201).send(`Movimiento de ${nuevoTipo === 0 ? 'entrada' : 'salida'} registrado exitosamente`);
    } catch (err) {
        console.error(err);
        res.status(500).send('Fallo al registrar movimiento');
    }
};
