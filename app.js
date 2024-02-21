const express = require('express');
const createError = require('http-errors');
const morgan = require('morgan');
const { Client } = require('whatsapp-web.js');
require('dotenv').config();

const SESSION_FILE_PATH = './session.json';
let sessionCfg;
if (fs.existsSync(SESSION_FILE_PATH)) {
  sessionCfg = require(SESSION_FILE_PATH);
}

const client = new Client({
  puppeteer: { headless: false }, // Make headless true or remove to run browser in background
  session: sessionCfg,
});

client.initialize();
