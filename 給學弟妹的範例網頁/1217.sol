// SPDX-License-Identifier: GPL-3.0
pragma solidity >=0.7.0 <0.9.0;

contract TranDetail {
    address owner;
    mapping(uint256 => pointList) allPointList; //用uint查，傳回pointList struct，使用方式如17行

    //考試分數
    struct pointList {
        uint256 point;
        string sId;
    }

    constructor() {
        owner = msg.sender;
    }

    modifier onlyOwner() {
        require(msg.sender == owner, "You are not owner!");
        _;
    }

    //新增考試分數，sId=學號，point=分數
    function addPointList(uint256 _point, string memory _sId)
        public
        onlyOwner
        returns (uint256)
    {
        uint256 blockId = block.number;
        allPointList[blockId] = pointList(_point, _sId);

        return (blockId);
    }

    //用blockid查詢考試分數，sId=學號，point=分數
    function readPointList(uint256 _blockId)
        public
        view
        returns (string memory, uint256)
    {
        uint256 blockId = _blockId;

        string memory sId = allPointList[blockId].sId;
        uint256 point = allPointList[blockId].point;

        return (sId, point);
    }
}
