var validate = {
		    //phone
		    phone: function(phone){
		        if(!/^(13[0-9]|15[0|1|2|3|6|7|8|9]|18[0-9]|177)\d{8}$/.test(phone)){
		            return false;
		        }
		        return true;
		    },
		    //身份证
		    card: function(card) {
		        var l = 0;
		        var i = card;
		        var m = {11: "北京",12: "天津",13: "河北",14: "山西",15: "内蒙",21: "辽宁",22: "吉林",23: "黑龙",31: "上海",32: "江苏",33: "浙江",34: "安徽",35: "福建",36: "江西",37: "山东",41: "河南",42: "湖北",43: "湖南",44: "广东",45: "广西",46: "海南",50: "重庆",51: "四川",52: "贵州",53: "云南",54: "西藏",61: "陕西",62: "甘肃",63: "青海",64: "宁夏",65: "新疆",71: "台湾",81: "香港",82: "澳门",91: "国外"};
		        if (!/^\d{17}(\d|x)$/i.test(i)) {
		            return false
		        }
		        i = i.replace(/x$/i, "a");
		        if (m[parseInt(i.substr(0, 2))] == null) {
		            return false
		        }
		        var n = i.substr(6, 4) + "-" + Number(i.substr(10, 2)) + "-" + Number(i.substr(12, 2));
		        var j = new Date(n.replace(/-/g, "/"));
		        if (n != (j.getFullYear() + "-" + (j.getMonth() + 1) + "-" + j.getDate())) {
		            return false
		        }
		        for (var d = 17; d >= 0; d--) {
		            l += (Math.pow(2, d) % 11) * parseInt(i.charAt(17 - d), 11)
		        }
		        if (l % 11 != 1) {
		            return false
		        }
		        return true;
		    },
		    
		    //银行卡号
		    bankNum: function(bankno) {
					    var lastNum=bankno.substr(bankno.length-1,1);
					    var first15Num=bankno.substr(0,bankno.length-1);
					    var newArr=new Array();
					    for(var i=first15Num.length-1;i>-1;i--){ 
					        newArr.push(first15Num.substr(i,1));
					    }
					    var arrJiShu=new Array(); 
					    var arrJiShu2=new Array(); 
					     
					    var arrOuShu=new Array(); 
					    for(var j=0;j<newArr.length;j++){
					        if((j+1)%2==1){
					            if(parseInt(newArr[j])*2<9)
					            arrJiShu.push(parseInt(newArr[j])*2);
					            else
					            arrJiShu2.push(parseInt(newArr[j])*2);
					        }
					        else 
					        arrOuShu.push(newArr[j]);
					    }
					     
					    var jishu_child1=new Array();
					    var jishu_child2=new Array();
					    for(var h=0;h<arrJiShu2.length;h++){
					        jishu_child1.push(parseInt(arrJiShu2[h])%10);
					        jishu_child2.push(parseInt(arrJiShu2[h])/10);
					    }        
					    var sumJiShu=0; 
					    var sumOuShu=0; 
					    var sumJiShuChild1=0; 
					    var sumJiShuChild2=0; 
					    var sumTotal=0;
					    for(var m=0;m<arrJiShu.length;m++){
					        sumJiShu=sumJiShu+parseInt(arrJiShu[m]);
					    }
					    for(var n=0;n<arrOuShu.length;n++){
					        sumOuShu=sumOuShu+parseInt(arrOuShu[n]);
					    }
					    for(var p=0;p<jishu_child1.length;p++){
					        sumJiShuChild1=sumJiShuChild1+parseInt(jishu_child1[p]);
					        sumJiShuChild2=sumJiShuChild2+parseInt(jishu_child2[p]);
					    }      
					    sumTotal=parseInt(sumJiShu)+parseInt(sumOuShu)+parseInt(sumJiShuChild1)+parseInt(sumJiShuChild2);
					    var k= parseInt(sumTotal)%10==0?10:parseInt(sumTotal)%10;        
					    var luhm= 10-k;
					    if(lastNum==luhm){
					    	return true;
					    }else{
					    	return false;
					    }        
				},
			banks:{
					  "SRCB": "深圳农村商业银行", 
					  "BGB": "广西北部湾银行", 
					  "SHRCB": "上海农村商业银行", 
					  "BJBANK": "北京银行", 
					  "WHCCB": "威海市商业银行", 
					  "BOZK": "周口银行", 
					  "KORLABANK": "库尔勒市商业银行", 
					  "SPABANK": "平安银行", 
					  "SDEB": "顺德农商银行", 
					  "HURCB": "湖北省农村信用社", 
					  "WRCB": "无锡农村商业银行", 
					  "BOCY": "朝阳银行", 
					  "CZBANK": "浙商银行", 
					  "HDBANK": "邯郸银行", 
					  "BOC": "中国银行", 
					  "BOD": "东莞银行", 
					  "CCB": "中国建设银行", 
					  "ZYCBANK": "遵义市商业银行", 
					  "SXCB": "绍兴银行", 
					  "GZRCU": "贵州省农村信用社", 
					  "ZJKCCB": "张家口市商业银行", 
					  "BOJZ": "锦州银行", 
					  "BOP": "平顶山银行", 
					  "HKB": "汉口银行", 
					  "SPDB": "上海浦东发展银行", 
					  "NXRCU": "宁夏黄河农村商业银行", 
					  "NYNB": "广东南粤银行", 
					  "GRCB": "广州农商银行", 
					  "BOSZ": "苏州银行", 
					  "HZCB": "杭州银行", 
					  "HSBK": "衡水银行", 
					  "HBC": "湖北银行", 
					  "JXBANK": "嘉兴银行", 
					  "HRXJB": "华融湘江银行", 
					  "BODD": "丹东银行", 
					  "AYCB": "安阳银行", 
					  "EGBANK": "恒丰银行", 
					  "CDB": "国家开发银行", 
					  "TCRCB": "江苏太仓农村商业银行", 
					  "NJCB": "南京银行", 
					  "ZZBANK": "郑州银行", 
					  "DYCB": "德阳商业银行", 
					  "YBCCB": "宜宾市商业银行", 
					  "SCRCU": "四川省农村信用", 
					  "KLB": "昆仑银行", 
					  "LSBANK": "莱商银行", 
					  "YDRCB": "尧都农商行", 
					  "CCQTGB": "重庆三峡银行", 
					  "FDB": "富滇银行", 
					  "JSRCU": "江苏省农村信用联合社", 
					  "JNBANK": "济宁银行", 
					  "CMB": "招商银行", 
					  "JINCHB": "晋城银行JCBANK", 
					  "FXCB": "阜新银行", 
					  "WHRCB": "武汉农村商业银行", 
					  "HBYCBANK": "湖北银行宜昌分行", 
					  "TZCB": "台州银行", 
					  "TACCB": "泰安市商业银行", 
					  "XCYH": "许昌银行", 
					  "CEB": "中国光大银行", 
					  "NXBANK": "宁夏银行", 
					  "HSBANK": "徽商银行", 
					  "JJBANK": "九江银行", 
					  "NHQS": "农信银清算中心", 
					  "MTBANK": "浙江民泰商业银行", 
					  "LANGFB": "廊坊银行", 
					  "ASCB": "鞍山银行", 
					  "KSRB": "昆山农村商业银行", 
					  "YXCCB": "玉溪市商业银行", 
					  "DLB": "大连银行", 
					  "DRCBCL": "东莞农村商业银行", 
					  "GCB": "广州银行", 
					  "NBBANK": "宁波银行", 
					  "BOYK": "营口银行", 
					  "SXRCCU": "陕西信合", 
					  "GLBANK": "桂林银行", 
					  "BOQH": "青海银行", 
					  "CDRCB": "成都农商银行", 
					  "QDCCB": "青岛银行", 
					  "HKBEA": "东亚银行", 
					  "HBHSBANK": "湖北银行黄石分行", 
					  "WZCB": "温州银行", 
					  "TRCB": "天津农商银行", 
					  "QLBANK": "齐鲁银行", 
					  "GDRCC": "广东省农村信用社联合社", 
					  "ZJTLCB": "浙江泰隆商业银行", 
					  "GZB": "赣州银行", 
					  "GYCB": "贵阳市商业银行", 
					  "CQBANK": "重庆银行", 
					  "DAQINGB": "龙江银行", 
					  "CGNB": "南充市商业银行", 
					  "SCCB": "三门峡银行", 
					  "CSRCB": "常熟农村商业银行", 
					  "SHBANK": "上海银行", 
					  "JLBANK": "吉林银行", 
					  "CZRCB": "常州农村信用联社", 
					  "BANKWF": "潍坊银行", 
					  "ZRCBANK": "张家港农村商业银行", 
					  "FJHXBC": "福建海峡银行", 
					  "ZJNX": "浙江省农村信用社联合社", 
					  "LZYH": "兰州银行", 
					  "JSB": "晋商银行", 
					  "BOHAIB": "渤海银行", 
					  "CZCB": "浙江稠州商业银行", 
					  "YQCCB": "阳泉银行", 
					  "SJBANK": "盛京银行", 
					  "XABANK": "西安银行", 
					  "BSB": "包商银行", 
					  "JSBANK": "江苏银行", 
					  "FSCB": "抚顺银行", 
					  "HNRCU": "河南省农村信用", 
					  "COMM": "交通银行", 
					  "XTB": "邢台银行", 
					  "CITIC": "中信银行", 
					  "HXBANK": "华夏银行", 
					  "HNRCC": "湖南省农村信用社", 
					  "DYCCB": "东营市商业银行", 
					  "ORBANK": "鄂尔多斯银行", 
					  "BJRCB": "北京农村商业银行", 
					  "XYBANK": "信阳银行", 
					  "ZGCCB": "自贡市商业银行", 
					  "CDCB": "成都银行", 
					  "HANABANK": "韩亚银行", 
					  "CMBC": "中国民生银行", 
					  "LYBANK": "洛阳银行", 
					  "GDB": "广东发展银行", 
					  "ZBCB": "齐商银行", 
					  "CBKF": "开封市商业银行", 
					  "H3CB": "内蒙古银行", 
					  "CIB": "兴业银行", 
					  "CRCBANK": "重庆农村商业银行", 
					  "SZSBK": "石嘴山银行", 
					  "DZBANK": "德州银行", 
					  "SRBANK": "上饶银行", 
					  "LSCCB": "乐山市商业银行", 
					  "JXRCU": "江西省农村信用", 
					  "ICBC": "中国工商银行", 
					  "JZBANK": "晋中市商业银行", 
					  "HZCCB": "湖州市商业银行", 
					  "NHB": "南海农村信用联社", 
					  "XXBANK": "新乡银行", 
					  "JRCB": "江苏江阴农村商业银行", 
					  "YNRCC": "云南省农村信用社", 
					  "ABC": "中国农业银行", 
					  "GXRCU": "广西省农村信用", 
					  "PSBC": "中国邮政储蓄银行", 
					  "BZMD": "驻马店银行", 
					  "ARCU": "安徽省农村信用社", 
					  "GSRCU": "甘肃省农村信用", 
					  "LYCB": "辽阳市商业银行", 
					  "JLRCU": "吉林农信", 
					  "URMQCCB": "乌鲁木齐市商业银行", 
					  "XLBANK": "中山小榄村镇银行", 
					  "CSCB": "长沙银行", 
					  "JHBANK": "金华银行", 
					  "BHB": "河北银行", 
					  "NBYZ": "鄞州银行", 
					  "LSBC": "临商银行", 
					  "BOCD": "承德银行", 
					  "SDRCU": "山东农信", 
					  "NCB": "南昌银行", 
					  "TCCB": "天津银行", 
					  "WJRCB": "吴江农商银行", 
					  "CBBQS": "城市商业银行资金清算中心", 
					  "HBRCU": "河北省农村信用社"
				},
				city:function(city_name){
					if(city_name.indexOf("北京")>=0){
						return 1;
					}else if(city_name.indexOf("上海")>=0){
						return 2;
					}else if(city_name.indexOf("天津")>=0){
						return 3;
					}else if(city_name.indexOf("重庆")>=0){
						return 4;
					}else if(city_name.indexOf("辽宁")>=0){
						return 5;
					}else if(city_name.indexOf("吉林")>=0){
						return 6;
					}else if(city_name.indexOf("黑龙江")>=0){
						return 7;
					}else if(city_name.indexOf("河北")>=0){
						return 8;
					}else if(city_name.indexOf("山西")>=0){
						return 9;
					}else if(city_name.indexOf("山东")>=0){
						return 10;
					}else if(city_name.indexOf("河南")>=0){
						return 11;
					}else if(city_name.indexOf("内蒙古")>=0){
						return 12;
					}else if(city_name.indexOf("陕西")>=0){
						return 13;
					}else if(city_name.indexOf("甘肃")>=0){
						return 14;
					}else if(city_name.indexOf("宁夏")>=0){
						return 15;
					}else if(city_name.indexOf("青海")>=0){
						return 16;
					}else if(city_name.indexOf("新疆")>=0){
						return 17;
					}else if(city_name.indexOf("福建")>=0){
						return 18;
					}else if(city_name.indexOf("湖南")>=0){
						return 19;
					}else if(city_name.indexOf("广东")>=0){
						return 20;
					}else if(city_name.indexOf("广西")>=0){
						return 21;
					}else if(city_name.indexOf("海南")>=0){
						return 22;
					}else if(city_name.indexOf("江苏")>=0){
						return 23;
					}else if(city_name.indexOf("浙江")>=0){
						return 24;
					}else if(city_name.indexOf("安徽")>=0){
						return 25;
					}else if(city_name.indexOf("江西")>=0){
						return 26;
					}else if(city_name.indexOf("湖北")>=0){
						return 27;
					}else if(city_name.indexOf("四川")>=0){
						return 28;
					}else if(city_name.indexOf("贵州")>=0){
						return 29;
					}else if(city_name.indexOf("云南")>=0){
						return 30;
					}else if(city_name.indexOf("西藏")>=0){
						return 31;
					}else if(city_name.indexOf("全国")>=0){
						return 0;
					}
					
				}
		    
		}