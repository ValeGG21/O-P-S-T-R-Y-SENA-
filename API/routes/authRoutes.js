const express = require('express');
const { registerUsuario } = require('../controllers/authController.js');
const { login } = require('../controllers/authController.js');
const { getUsuario } = require('../controllers/authController.js');
const { verifyToken } = require('../middleware/authMiddleware.js');

const router = express.Router();

router.post('/registrarUsuario', registerUsuario);
router.post('/login', login);
router.get('/perfil', verifyToken, getUsuario);

module.exports = router;