const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
const Usuario = require('../models/Usuario.js');

exports.registerUsuario = async (req, res) => {
    try {
        const { tipo_documento, numero_documento, nombre, apellido, sede_id, telefono, contra, rol } = req.body;

        if (!tipo_documento || !numero_documento || !nombre || !apellido || !sede_id || !telefono || !contra || !rol) {
            return res.status(400).send('Todos los campos son requeridos');
        }

        const contraEncriptada = await bcrypt.hash(contra, 10);

        await Usuario.create({
            tipo_documento,
            numero_documento,
            nombre,
            apellido,
            sede_id,
            telefono,
            contra: contraEncriptada,
            rol,
            novedad: 'Creación'
        });

        res.status(201).send('Usuario registrado correctamente');
    } catch (err) {
        console.error(err);
        res.status(500).send('Error al registrar');
    }
};

exports.login = async (req, res) => {
    try {
        const { numero_documento, contra } = req.body;
        const usuario = await Usuario.findOne({ where: { numero_documento: numero_documento } });

        if (!usuario) {
            return res.status(404).send('Usuario no encontrado');
        }

        const validacion = await bcrypt.compare(contra, usuario.contra);

        if (!validacion) {
            return res.status(401).send('Contraseña incorrecta');
        }

        const token = jwt.sign({ id: usuario.id_usuario, rol: usuario.rol }, process.env.SECRET_KEY, { expiresIn: '1h' });
        res.json({ token, rol: usuario.rol, id_usuario: usuario.id_usuario});
    } catch (err) {
        console.error(err);
        res.status(500).send('Error al iniciar sesión');
    }
};

exports.getUsuario = async (req, res) => {
    try {
        const id = req.user.id; // Asegúrate de que req.user contenga el ID correcto
        const usuario = await Usuario.findByPk(id);
        if (!usuario) {
            return res.status(404).send('Usuario no encontrado');
        }
        res.json(usuario);
    } catch (err) {
        res.status(500).send('Error al obtener el usuario');
    }
};

exports.getUsuarios = async (req, res) => {
    try {
        const usuarios = await Usuario.findAll();
        if (!usuarios) {
            return res.status(404).send({ message: 'No hay usuarios' })
        }
        res.json(usuarios);
    } catch (err) {
        console.error(err);
        res.status(500).json({ message: 'Error al obtener las sedes' });
    }
}

// async function crearSuperAdmin() {
//     try {
//         const hashedPassword = await bcrypt.hash('superadmin77', 10);

//         const superAdmin = await Usuario.create({
//             tipo_documento: 'CC',
//             numero_documento: '1017941691',
//             nombre: 'Nicolas',
//             apellido: 'Gil Vergara',
//             sede_id: 1,
//             telefono: '3054609660',
//             contra: hashedPassword,
//             rol: 'SuperAdmin',
//             novedad: 'Creación de SuperAdmin',
//         });

//         console.log('SuperAdmin creado:', superAdmin);
//     } catch (error) {
//         console.error('Error creando SuperAdmin:', error);
//     }
// }

// crearSuperAdmin();
