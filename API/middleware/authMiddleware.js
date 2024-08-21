const jwt = require("jsonwebtoken")

exports.verifyToken = (req, res, next) => {
    const token = req.headers['authorization']
    if(!token){
        return res.status(403).json({error: "Acceso denegado, has tratado de ingresar sin ser autorizado"})
    }
    try{
        const decoded = jwt.verify(token, procces.env.JWT_SECRET)
        req.user = decoded
        next()
    } catch(err){
        res.status(401).json({error: "Token inválido o expirado"})
    }
}

exports.isAdmin = (req, res , next) => {
    if(req.user.rol != "admin"){
        return res.status(403).json({error: "Acceso solo válido para administradores"})
    }
    next()
}

exports.isVigilante = (req, res, next) => {
    if(req.user.rol != "vigilante"){
        return res.status(403).json({error: "Acceso solo válido para vigilantes"})
    }
    next()
}