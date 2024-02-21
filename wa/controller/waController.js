const { Client, LocalAuth, MessageMedia } = require("whatsapp-web.js");
const qrcode = require("qrcode-terminal");
const axios = require("axios");

const client = new Client({
    authStrategy: new LocalAuth({
        dataPath: 'wa-client'
    }),
    puppeteer: {
        headless: 'new',
        args: ['--no-sandbox', '--disable-setuid-sandbox'],
    },
});

client.initialize();

client.on("qr", (qr) => {
    qrcode.generate(qr, { small: true });
});

client.on("authenticated", (session) => {
    console.log("AUTHENTICATED");
});

client.on("auth_failure", (msg) => {
    // Fired if session restore was unsuccessful
    console.error("AUTHENTICATION FAILURE", msg);
});

client.on("ready", () => {
    console.log("READY TO USE!");
});

client.on("message", async (message) => {
    if (message.body.toUpperCase === "!MEME" || message.body === "MEME") {
        await client.sendMessage(
            message.from,
            'Meme kita semua ketik "!passwordnya" atau "!flashdisk"'
        );
    }
});

client.on("message", async (message) => {
    if (
        message.body.toLowerCase === "!passwordnya" ||
        message.body === "passwordnya"
    ) {
        await client.sendMessage(message.from, "Mariadi..");
        await client.sendMessage(message.from, 'Hak"e Hak"e..');
        // const media = MessageMedia.fromFilePath("./video/marilah.mp4");
        await client.sendMessage(message.from, media);
        // console.log(message.body);
    } else if (
        message.body.toLowerCase === "!flashdisk" ||
        message.body === "flashdisk"
    ) {
        await client.sendMessage(message.from, "Jogeto disk Flashdisk..");
        await client.sendMessage(message.from, 'Hak"e Hak"e..');
        // const media = MessageMedia.fromFilePath("./video/flashdisk.mp4");
        await client.sendMessage(message.from, media);
        // console.log(message.body);
    }
});

client.on("message", async (message) => {
    var base_url = `https://sandalmely.com/api/v1`;
    var text = message.body.toUpperCase();

    if (text === "HELP" || text === "!HELP") {
        axios
            .get(base_url + `/wa`)
            .then(async (res) => {
                if (res.data.error) {
                    message.reply("Maaf Kata Kunci Salah ?");
                } else {
                    client.sendMessage(
                        message.from,
                        ` *${res.data.info}* \n=============================\nFormat : \n _*${res.data.order}*_ \n=============================\nContoh : \n_*${res.data.contoh}*_`
                    );
                }
            })
            .catch((error) => {
                console.error(error);
            });
    } else if (text.match(/CEK EVA.*/)) {
        const str = text;
        const result = str.split(/[, ]+/);
        const tigaarray = result.slice(0, 3);
        let number_orang = message.from;
        nohp = number_orang.replace(/\+/g, "");
        nohp = number_orang.replace(/\s/g, "");
        nohp = number_orang.replace(/\D/g,'');
        if (nohp.startsWith("62")) {
            hape = "0" + nohp.slice(2);
        }else{
            message.reply(" _*NOMOR HP TIDAK SESUAI ATAU BELUM TERISI*_ ");
        }

        if (tigaarray[1] != undefined && tigaarray[0] == "CEK") {
            axios
                .get(base_url + `/wa/${encodeURIComponent(
                    hape
                )}?type=order&order_id=${encodeURIComponent(
                    tigaarray[1]
                )}&pin=${encodeURIComponent(
                    tigaarray[2]
                )}`)
                .then(async (res) => {
                    console.log(res);
                    if (res.data.data.status == 0) {
                        var nilai = " _*Proses*_ "
                    } else if (res.data.data.status == 1) {
                        var nilai = " _*Dikirim Sebagian*_ "
                    } else if (res.data.data.status == 2) {
                        var nilai = " _*Dikirim Semua*_ "
                    } else {
                        var nilai = " _*Selesai*_ "
                    }

                    const items = res.data.data.items;

                    let messageText = `\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tOrder : _*OR00${res.data.data.id}*_ \r\n=========================== \r\n \t\t\t\t\t\t\t\t Status : ${nilai}\r\n \t\t\t\t\t\t\t\t Tanggal : _*${res.data.data.created_at}*_ \r\n===========================\r\n`;

                    items.forEach(item => {
                        if (item.status == 0) {
                            var nilai_item = " _*Proses*_ "
                        } else if (item.status == 1) {
                            var nilai_item = " _*Dikirim*_ "
                        } else{
                            var nilai_item = " _*Selesai*_ "
                        }

                        messageText += `Barang : _*${item.product.article.nama_artikel}*_ \r\n`;
                        messageText += `Qty : _*${item.quantity} Krg*_ \r\n`;
                        messageText += `Status : ${nilai_item} \r\n`;
                        messageText += `----------------------------\r\n`;
                        // messageText += `uuid: ${item.uuid}\r\n`;
                    });

                    client.sendMessage(message.from, messageText);

                }).catch((error) => {
                    // console.error(error);
                    message.reply(" _*ORDER NUMBER*_ / _*PIN*_ Anda Salah ");
                });
        }
    } else {
        // console.log(text);
    }
});

const api = async (req, res) => {
    let nohp = req.query.nohp;
    const pesan = req.query.pesan;
    nohp = nohp.replace(/\+/g, "");
    nohp = nohp.replace(/\s/g, "");

    try {
        if (nohp.startsWith("0")) {
            hape = "62" + nohp.slice(1) + "@c.us";
            // console.log(hape);
        } else if (nohp.startsWith("62")) {
            hape = nohp + "@c.us";
            // console.log(hape);
        } else {
            res.json({ status: 404, messages: "Nomber format not correct" });
        }

        const user = await client.isRegisteredUser(hape);
        if (user) {
            client.sendMessage(hape, pesan);
            res.json({
                status: 200,
                messages: "Pesan Terkirim",
                nomor: nohp,
                pesan: pesan,
            });
        } else {
            res.json({ status: 404, messages: "User is not registered" });
        }
    } catch (err) {
        // console.log(err);
        res.status(500).json({ messages: "Eror Server" });
    }
};

module.exports = api;
