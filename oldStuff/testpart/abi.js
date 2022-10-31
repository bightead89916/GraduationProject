var abi = [{
        "inputs": [],
        "stateMutability": "nonpayable",
        "type": "constructor"
    },
    {
        "inputs": [{
                "internalType": "string",
                "name": "_stuId",
                "type": "string"
            },
            {
                "internalType": "address",
                "name": "_stuAddress",
                "type": "address"
            }
        ],
        "name": "addStu",
        "outputs": [],
        "stateMutability": "nonpayable",
        "type": "function"
    },
    {
        "inputs": [{
                "internalType": "string",
                "name": "_tchId",
                "type": "string"
            },
            {
                "internalType": "address",
                "name": "_tchAddress",
                "type": "address"
            }
        ],
        "name": "addTch",
        "outputs": [],
        "stateMutability": "nonpayable",
        "type": "function"
    },
    {
        "inputs": [{
                "internalType": "string",
                "name": "_stuId",
                "type": "string"
            },
            {
                "internalType": "address",
                "name": "_newAddress",
                "type": "address"
            }
        ],
        "name": "changeStuAddress",
        "outputs": [],
        "stateMutability": "nonpayable",
        "type": "function"
    },
    {
        "inputs": [{
                "internalType": "string",
                "name": "_tchId",
                "type": "string"
            },
            {
                "internalType": "address",
                "name": "_newAddress",
                "type": "address"
            }
        ],
        "name": "changeTchAddress",
        "outputs": [],
        "stateMutability": "nonpayable",
        "type": "function"
    },
    {
        "inputs": [{
            "internalType": "string",
            "name": "_stuId",
            "type": "string"
        }],
        "name": "readRP",
        "outputs": [{
            "internalType": "uint256",
            "name": "",
            "type": "uint256"
        }],
        "stateMutability": "view",
        "type": "function"
    },
    {
        "inputs": [{
            "internalType": "string",
            "name": "_stuId",
            "type": "string"
        }],
        "name": "readStuAddress",
        "outputs": [{
            "internalType": "address",
            "name": "",
            "type": "address"
        }],
        "stateMutability": "view",
        "type": "function"
    },
    {
        "inputs": [{
            "internalType": "string",
            "name": "_tchId",
            "type": "string"
        }],
        "name": "readTchAddress",
        "outputs": [{
            "internalType": "address",
            "name": "",
            "type": "address"
        }],
        "stateMutability": "view",
        "type": "function"
    }
]