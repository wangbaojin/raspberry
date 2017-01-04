const validate = {
			//域名
			url:"https://test.wangbaojin1006.cn",
		    //phone
		    phone: function(phone){
		        if(!/^(13[0-9]|15[0|1|2|3|6|7|8|9]|18[0-9]|177)\d{8}$/.test(phone)){
		            return false;
		        }
		        return true;
		    }
}