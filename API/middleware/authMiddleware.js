const jwt = require("jsonwebtoken");

exports.verifyToken = (req, res, next) => {
    const token = req.headers['authorization'];
    if (!token) {
        return res.status(403).json({ error: "Acceso denegado, no se proporcionó un token" });
    }
    try {
        const decoded = jwt.verify(token, process.env.JWT_SECRET);
        req.usuario = decoded;
        next();
    } catch (err) {
        res.status(401).json({ error: "Token inválido o expirado" });
    }
};

exports.isAdmin = (req, res, next) => {
    if (req.usuario.rol !== "admin") {
        return res.status(403).json({ error: "Acceso solo válido para administradores" });
    }
    next();
};

exports.isVigilante = (req, res, next) => {
    if (req.usuario.rol !== "vigilante") {
        return res.status(403).json({ error: "Acceso solo válido para vigilantes" });
    }
    next();
};
