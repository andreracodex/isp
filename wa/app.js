const express = require('express')
const app = express()
const PORT = process.env.PORT || 3000;  // correct
const router = require('./routers/wa')

app.use('/',router);

app.listen(PORT, () => {
    console.log(`Example app listening on port ${PORT}`)
})
