const express = require("express")
const { verifyToken, isVigilante } = require("../middleware/authMiddleware.js")
const { createEquipo, getEquipo, updateEquipo, ingresoYSalida } = require("../controllers/equipmentController.js")

const router = express.Router()

router.post('/registrarEquipo', verifyToken, isVigilante, createEquipo)
router.get('/:codigoBarras', verifyToken, getEquipo)
router.put('/:codigoBarras', verifyToken, isVigilante, updateEquipo)
router.post('/:codigoBarras/mark', verifyToken, isVigilante, ingresoYSalida)

module.exports = router