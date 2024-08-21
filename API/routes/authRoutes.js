const express = require("express")
const bcrypt = require("bcrypt")
const jwt = require("jsonwebtoken")
const { registerUsuario, login, getUsuario } = require("../controllers/authController")
const { verifyToken, isAdmin } = require("../middleware/authMiddleware")


const router = express.Router()

router.post('/registrarUsuario', registerUsuario)
router.post('/iniciarSesion', login)
router.get('/perfil', verifyToken, getUsuario)

module.exports = router