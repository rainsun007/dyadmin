var jsondata={
	"title": "newFlow_1sfdsffewewfewfwfwefewfwfewfewfew",
	"nodes": {
		"demo_node_1": {
			"name": "开始",
			"left": 42,
			"top": 38,
			"type": "start round mix",
			"width": 26,
			"height": 26,
			"alt": true,
            "marked":true
		},
		"demo_node_2": {
			"name": "结束",
			"left": 797,
			"top": 42,
			"type": "end round mix",
			"width": 26,
			"height": 26,
			"alt": true
		},
		"demo_node_3": {
			"name": "入职申请<br>用户1，用户2",
			"left": 155,
			"top": 39,
			"type": "task mix",
			"width": 124,
			"height": 26,
			"alt": true,
            "marked":true
		},
		"demo_node_4": {
			"name": "人力审批",
			"left": 364,
			"top": 42,
			"type": "task mix",
			"width": 104,
			"height": 26,
			"alt": true,
            "marked":true
		},
		"demo_node_8": {
			"name": "工资判断",
			"left": 571,
			"top": 43,
			"type": "node",
			"width": 104,
			"height": 26,
			"alt": true
		},
		"demo_node_9": {
			"name": "经理终审",
			"left": 559,
			"top": 141,
			"type": "task",
			"width": 104,
			"height": 26,
			"alt": true
		}
	},
	"lines": {
		"demo_line_5": {
			"type": "sl",
			"from": "demo_node_3",
			"to": "demo_node_4",
			"name": "提交申请",
            "marked":true
		},
		"demo_line_6": {
			"type": "sl",
			"from": "demo_node_1",
			"to": "demo_node_3",
			"name": "",
            "marked":true
		},
		"demo_line_7": {
			"type": "tb",
			"M": 18.5,
			"from": "demo_node_4",
			"to": "demo_node_3",
			"name": "不通过",
            "marked":true
		},
		"demo_line_10": {
			"type": "sl",
			"from": "demo_node_4",
			"to": "demo_node_8",
			"name": "通过"
		},
		"demo_line_11": {
			"type": "tb",
			"M": 157,
			"from": "demo_node_9",
			"to": "demo_node_4",
			"name": "不接受",
			"alt": true
		},
		"demo_line_12": {
			"type": "sl",
			"from": "demo_node_8",
			"to": "demo_node_9",
			"name": "大于8000"
		},
		"demo_line_13": {
			"type": "sl",
			"from": "demo_node_8",
			"to": "demo_node_2",
			"name": "小于8000"
		},
		"demo_line_14": {
			"type": "sl",
			"from": "demo_node_9",
			"to": "demo_node_2",
			"name": "接受"
		}
	},
	"areas": {
		
	},
	"initNum": 15
};