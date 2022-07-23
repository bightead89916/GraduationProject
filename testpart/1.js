let user;
var test, userAccount;
var testAddress = "0x1D4e6Cd78D37A8f997e93A55b5f92979D5109F27"; //4_9Address

$(".btn.login").click(async() => { //連結metamask
    try {
        web3js = new Web3(window.ethereum); //建立web3連結
        const accounts = await window.ethereum.request({
            method: 'eth_requestAccounts'
        });
        user = accounts[0];
        $("#username").html(user);

        test = new web3js.eth.Contract(abi, testAddress); //合約
    } catch (error) {
        alert(error.message);
    }
})

$(".btn.readRP").click(async() => {
    try {
        readRPbyID = document.getElementById("readRPbyID").value;
        var RP = await test.methods.readRP(readRPbyID).call({ from: user });
        $("#RP").html(RP);
    } catch (error) {
        alert(error.message);
    }
})

$(".btn.readStuAddr").click(async() => {
    try {
        readRPbyID = document.getElementById("readRPbyID").value;
        var readStuAddr = await test.methods.readStuAddress(readRPbyID).call({ from: user });
        $("#readStuAddr").html(readStuAddr);
    } catch (error) {
        alert(error.message);
    }
})

$(".btn.changeStuAddress").click(async() => { //1.新增2.讀取試試
    try {
        _stuId = document.getElementById("changeById").value;
        _stuAddress = document.getElementById("changeByAddr").value;
        await test.methods.changeStuAddress(_stuId, _stuAddress).send({ from: user });
    } catch (error) {
        alert(error.message);
    }
})

$(".btn.addStu").click(async() => { //1.新增2.讀取試試
    try {
        _stuId = document.getElementById("add_stuId").value;
        _stuAddress = document.getElementById("add_stuAddress").value;
        //$("#RP").html(_stuId + _stuAddress); //測試用顯示
        await test.methods.addStu(_stuId, _stuAddress).send({ from: user });
    } catch (error) {
        alert(error.message);
    }
})