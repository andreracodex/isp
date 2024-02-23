const express = require('express');
// const api = require('../controller/waController');
const router = express.Router();

const { Client, LocalAuth, MessageMedia } = require("whatsapp-web.js");
const axios = require("axios");
const client = new Client({
    authStrategy: new LocalAuth({
        dataPath: '../wa-client/auth/'
    }),
    puppeteer: {
        headless: 'new',
        args: ['--no-sandbox', '--disable-setuid-sandbox'],
    },
});

// router.get("/api", api);
router.get("/client", function (req, res) {
    try{
        client.on('qr', (qr) => {
            res.json({ 'qr' : qr });
        });
        client.on('ready', () => {
            res.send('Ready');
        });
        client.initialize();
    }catch{
        res.send(400, 'failed');
    }

});

router.get("/test", function (req, res) {
    res.send('test');
});

module.exports = router;
