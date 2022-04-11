let user;
var test, userAccount;


//const balanceAddr = "0xF5E5Aa0CC204bb848aDCA71BeEe8fF7F194f14A8";

// $(".btn.login").click(async() => { //連結metamask
//     try {
//         const accounts = await window.ethereum.request({
//             method: 'eth_requestAccounts',
//         });
//         user = accounts[0];
//         $(".btn.login").html("Connected");
//         $("#username").html(user);

//         var Web3 = require('web3');
//         // set the provider of web3
//         if (typeof web3 !== 'undefined') {
//             console.debug(web3.currentProvider);
//             web3 = new Web3(web3.currentProvider);
//         } else {
//             alert("No currentProvider for web3");
//         }

//     } catch (error) {
//         alert(error.message);
//     }
// })
$(".btn.login").click(async() => { //連結metamask
    try {
        web3js = new Web3(window.ethereum); //建立web3連結
        const accounts = await window.ethereum.request({
            method: 'eth_requestAccounts'
        });
        user = accounts[0];
        $("#username").html(user);
        startApp();
    } catch (error) {
        alert(error.message);
    }
})

function startApp() {
    var testAddress = "0x1D4e6Cd78D37A8f997e93A55b5f92979D5109F27"; //4_9Address
    test = new web3js.eth.Contract(abi, testAddress);
    userAccount = web3js.currentProvider.selectedAddress;
    $("#RP").html(userAccount);
}

// $(".btn.getPoint").click(async() => {
//     try {
//         getBalance = new web3.eth.Contract(abi.balance, balanceAddr, { from: user });
//     } catch (error) {
//         alert(error.message);
//     }

//     var balanceAddr = "0xF5E5Aa0CC204bb848aDCA71BeEe8fF7F194f14A8";
//     balanceAddr = new web3js.eth.Contract(abi.balance, balanceAddr);
//     console.log("userAccount = " + user);
// })

$(".btn.readRP").click(async() => {
    try {
        var RP = await abi.methods.readRP(_stuId).call({ from: userAccount });
        $("#RP").html(RP);
    } catch (error) {
        alert(error.message);
    }
})

$(".btn.addStu").click(async() => { //1.新增2.讀取試試
    try {
        _stuId = document.getElementById("add_stuId").value;
        _stuAddress = document.getElementById("add_stuAddress").value;
        $("#RP").html(_stuId + _stuAddress); //測試用顯示
        await abi.methods.addStu(_stuId, _stuAddress).send({ from: user });
    } catch (error) {
        alert(error.message);
    }
})