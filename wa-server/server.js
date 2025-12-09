const {
    default: makeWASocket,
    useMultiFileAuthState
} = require('@whiskeysockets/baileys')

const express = require('express')
const qrcode = require('qrcode-terminal')
const cors = require('cors')

const app = express()
app.use(express.json())
app.use(cors())

let sock

async function connectWA() {
    const { state, saveCreds } = await useMultiFileAuthState('./baileys_auth')

    sock = makeWASocket({
        printQRInTerminal: true,
        auth: state
    })

    sock.ev.on('creds.update', saveCreds)

    sock.ev.on('connection.update', ({ connection, lastDisconnect, qr }) => {

        if (qr) {
            console.log('SCAN QR DI TERMINAL!')
            qrcode.generate(qr, { small: true })
        }

        if (connection === 'open') {
            console.log('WA CONNECTED!')
        }

        if (connection === 'close') {
            console.log('Connection closed. Reconnecting in 3 sec...')
            setTimeout(() => connectWA(), 3000)
        }
    })
}

connectWA()

// API KIRIM PESAN
app.post('/send', async (req, res) => {
    try {
        const { number, message } = req.body

        if (!number || !message)
            return res.status(400).json({ error: 'number & message required' })

        const jid = number.replace(/[^0-9]/g, '') + '@s.whatsapp.net'

        await sock.sendMessage(jid, { text: message })

        res.json({ success: true })
    } catch (e) {
        res.status(500).json({ error: e.message })
    }
})

app.listen(5000, () => {
    console.log('WA API running on port 5000')
})
