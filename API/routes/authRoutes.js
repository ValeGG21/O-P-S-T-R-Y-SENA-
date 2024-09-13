const express = require('express')
const { login, getUsuario, registerUsuario, getUsuarios } = require('../controllers/authController.js');
const { verifyToken } = require('../middleware/authMiddleware.js');

const router = express.Router();

router.post('/', getUsuarios);
router.post('/registrarUsuario', registerUsuario);
router.post('/login', login);
router.get('/perfil', verifyToken, getUsuario);

module.exports = router;    