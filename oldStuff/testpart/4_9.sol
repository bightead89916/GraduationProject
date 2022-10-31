// SPDX-License-Identifier: GPL-3.0

pragma solidity >=0.7.0 <0.9.0;

contract Test{
//變數
    //地址
    address owner;//學校
    mapping(string => address) stuAddress;//學生
    mapping(string => address) tchAddress;//老師

    //判斷是否已存在
    mapping(string => bool) stuExist;//學生
    mapping(string => bool) tchExist;//老師
    mapping(address => bool) addressExist;//地址

    //學生的點數
    mapping(address => uint) stuPoint;

    //學生的獎懲
    mapping(address => uint) stuCom;//嘉獎
    mapping(address => uint) stuMiMe;//小功
    mapping(address => uint) stuMaMe;//大功
    mapping(address => uint) stuAdm;//警告
    mapping(address => uint) stuMiDe;//小過
    mapping(address => uint) stuMaDe;//大過
    //mapping(address => mapping(uint => uint)) stuPR; 或這種方法

//共同
    //讀取獎懲
    function readRP(string memory _stuId) public view returns(uint){
        address Address = stuAddress[_stuId];
        return stuCom[Address];
    }
    //讀取學生地址
    function readStuAddress(string memory _stuId) public view returns(address){
        return stuAddress[_stuId];
    }
    //讀取老師地址
    function readTchAddress(string memory _tchId) public view returns(address){
        return tchAddress[_tchId];
    }

//學校
    //指定Owner
    constructor(){
        owner = msg.sender;
    }
    modifier onlyOwner {
        require(msg.sender == owner, "You are not owner!");
        _;
    }

    //新增學生
    function addStu(string memory _stuId, address _stuAddress) public {
        require(stuExist[_stuId] == false, "Student is exist");
        require(addressExist[_stuAddress] == false, "Address is exist");

        stuAddress[_stuId] = _stuAddress;
        stuPoint[_stuAddress] = 0;
        stuCom[_stuAddress] = 0;
        stuMiMe[_stuAddress] = 0;
        stuMaMe[_stuAddress] = 0;
        stuAdm[_stuAddress] = 0;
        stuMiDe[_stuAddress] = 0;
        stuMaDe[_stuAddress] = 0;
        addressExist[_stuAddress] = true;
        stuExist[_stuId] = true;
    }
    //新增老師
    function addTch(string memory _tchId, address _tchAddress) public {
        require(tchExist[_tchId] == false, "Teacher is exist");
        require(addressExist[_tchAddress] == false, "Address is exist");

        tchAddress[_tchId] = _tchAddress;
        addressExist[_tchAddress] = true;
        tchExist[_tchId] = true;
    }

    //更改學生地址
    function changeStuAddress(string memory _stuId, address _newAddress) public {
        require(stuExist[_stuId] == true, "Student is not exist");
        require(addressExist[_newAddress] == false, "Address is exist");

        address origiAddress = stuAddress[_stuId];
        stuAddress[_stuId] = _newAddress;
        //點數
        stuPoint[stuAddress[_stuId]] = stuPoint[origiAddress];
        stuPoint[origiAddress] = 0;
        //獎懲
        stuCom[_newAddress] = stuCom[origiAddress];
        stuMiMe[_newAddress] = stuMiMe[origiAddress];
        stuMaMe[_newAddress] = stuMaMe[origiAddress];
        stuAdm[_newAddress] = stuAdm[origiAddress];
        stuMiDe[_newAddress] = stuMiDe[origiAddress];
        stuMaDe[_newAddress] = stuMaDe[origiAddress];
        stuCom[origiAddress] = 0;
        stuMiMe[origiAddress] = 0;
        stuMaMe[origiAddress] = 0;
        stuAdm[origiAddress] = 0;
        stuMiDe[origiAddress] = 0;
        stuMaDe[origiAddress] = 0;
        //地址
        addressExist[origiAddress] = false;
        addressExist[_newAddress] = true;
    }
    //更改老師地址
    function changeTchAddress(string memory _tchId, address _newAddress) public {
        require(tchExist[_tchId] == true, "Teacher is not exist");
        require(addressExist[_newAddress] == false, "Address is exist");

        address origiAddress = tchAddress[_tchId];
        tchAddress[_tchId] = _newAddress;
        addressExist[origiAddress] = false;
        addressExist[_newAddress] = true;
    }

//學生
    //兌換點數
    //function changeToPoint

//老師
    //給予學生獎懲
    //function giveStuPR
}