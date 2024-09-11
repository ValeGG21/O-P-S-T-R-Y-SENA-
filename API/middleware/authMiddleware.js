const jwt = require("jsonwebtoken");

exports.verifyToken = (req, res, next) => {
    const token = req.headers['authorization'];
    
    if (!token) {
        return res.status(403).json({ error: "Acceso denegado, no se proporcionó un token" });
    }

    try {
        const decoded = jwt.verify(token, process.env.SECRET_KEY);
        req.usuario = decoded;

        next();
    } catch (err) {
        res.status(401).json({ error: "Token inválido o expirado" });
    }
};

exports.isSuperAdmin = (req, res, next) => {
    if (req.usuario.rol !== "SuperAdmin") {
        return res.status(403).json({ error: "Acceso solo válido para SuperAdmin" });
    }
    next();
};

exports.isDirector = (req, res, next) => {
    if (req.usuario.rol !== "Director") {
        return res.status(403).json({ error: "Acceso solo válido para Directores de sede" });
    }
    next();
};

exports.isVigilante = (req, res, next) => {
    if (req.usuario.rol !== "Vigilante") {
        return res.status(403).json({ error: "Acceso solo válido para Vigilantes" });
    }
    next();
};

exports.isUsuarioComun = (req, res, next) => {
    if (req.usuario.rol !== "UsuarioComun") {
        return res.status(403).json({ error: "Acceso solo válido para Usuarios Comunes" });
    }
    next();
};