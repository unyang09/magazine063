const maria = require('mysql');

const conn = maria.createConnection({
    // host:'localhost',
    // port:3306,
    // user:'root',
    // password:'cisone1!!',
    // database:'smile063'

    host:'magazine063.com',
    port:3306,
    user:'magazine063',
    password:'gywkfh100!!',
    database:'magazine063'
});

module.exports=conn;