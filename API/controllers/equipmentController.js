const { Equipo, Movimiento } = require('../models')
const path = require('path')
const { generarCodBarras } = require('../utils/generadorCodBarras')

exports.createEquipo = async (req, res) => {
    try {
        const { marca, descripcion, usuario_id } = req.body
        const textoCodBarras = `${marca}-${usuario.documento}`
        const nuevoEquipo = await Equipo.create({ 
            marca, 
            descripcion, 
            codigoBarras: textoCodBarras,
            usuario_id,
            novedad: 'Recien creado'
        })

        const rutaCodBarras = path.join(__dirname, `../codBarras/${ textoCodBarras }.png`)
        await generarCodBarras(textoCodBarras, rutaCodBarras)
        res.status(201).json({
            message: 'equipo registrado',
            equipo: nuevoEquipo,
            codigoBarras: `/codBarras/${ textoCodBarras }.png`
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
        const { codigoBarras } = req.params
        const { tipo } = req.body

        const ultimo = await Movimiento.findOne({
            where: { equipo_id },
            order: [['id_movimiento', 'DESC']]
        })

        const nuevoMov = ultimo ? (ultimo.tipo === 0 ? 1 : 0) : 0
        const movimiento = await Movimiento.create({ codigoBarras, tipo: nuevoMov })
        res.status(201).send(`Movimiento de ${newTipo === 0 ? 'entrada' : 'salida'} registrado exitosamente`)
    } catch (err) {
        console.error(err)
        res.status(500).send('Fallo al registrar movimiento')
    }
};
