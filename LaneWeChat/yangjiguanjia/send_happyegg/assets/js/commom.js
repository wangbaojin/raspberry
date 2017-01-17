const validate = {
			//域名
			url:"http://weixin.yangjiguanjia.com",
		    //phone
		    phone: function(phone){
		        if(!/^(13[0-9]|15[0|1|2|3|6|7|8|9]|18[0-9]|17[0-9])\d{8}$/.test(phone)){
		            return false;
		        }
		        return true;
		    }
}