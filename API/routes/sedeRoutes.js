const express = require('express');
const { createSede, getSede, updateSede, deleteSede, getSedes } = require('../controllers/sedeController.js')
const { verifyToken, isSuperAdmin } = require('../middleware/authMiddleware.js');

const router = express.Router();


router.post('/', verifyToken, getSedes);
router.post('/createSede', verifyToken, isSuperAdmin, createSede);
router.get('/sede/:id_sede', verifyToken, isSuperAdmin, getSede);
router.put('/updateSede/:id_sede', verifyToken, isSuperAdmin, updateSede);
router.delete('/deleteSede/:id_sede', verifyToken, isSuperAdmin, deleteSede);

module.exports = router;