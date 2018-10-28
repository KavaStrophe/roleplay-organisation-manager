/** 
 * Function: DynamitablePos
 * 		Method to use on Jquery object targeting a HTML table. This build a dynamical table with a lot options and data.
 * 
 * Parameters:
 * 		jsonContent - JSON Object, containing all the options of the table : 
 * 			tableData :  JSON object containing the data of the table
 * 			champs_alwaysHidden : Array containing the names of the columns to not show.
 * 			champs_noFilter : Array containing the names of the columns who won't have a filter form
 * 			noExportCSV : Array containing the names of the columns who won't be export with CSV creation
 * 			isDelete : boolean, (default : true), show or hide the delete line button
 * 			isEdit : boolean, (default : true), show or hide the edit line button
 * 			isAction : boolean, (default : true), show or hide the Actions column and apply class in consequence
 * 			...
 * 
 * Returns:
 * 		String - Containing the HTML code of the form.
 */
;(function($,window,document,undefined){ 'use strict';

   	var DynamitablePos = function(ele, options){
   		this.$element = ele,
   		this.defaults ={						
			champs_noFilter:[],
			champs_alwaysExportCSV: [],
   			champs_alwaysHidden : [],
			columnHidden : [],
			champsFixed : [],
			specialChamp :[],
			noExportCSV : [],
			keyboard: true,
	        dblclick: true,
	        button: true,
	        buttonSelector: ".edit",
	        buttonCancel: ".cancel",
	        buttonRemove: ".delete",
	        maintainWidth: true,
	        dropdowns: {},
	        dropdownsAccesses: {},
	        controller : null,
	        editAction : "edit",
	        deleteAction : "delete",
	        isDelete : true,
	        isEdit : true,
	        isAction : true,
	        DbClickEventFilter:function(){return true;},
	        ExportCSVSpec:function(){return false;},
	        edit: function() {},
	        save: function() {},
	        cancel: function() {}
   		},
   		this.options = $.extend({}, this.defaults, options);
   		this.filterDataResult,
   		this.controller,
   		this.tableName,
   		this.pageName,  
        this.tableData = this.options.tableData;
   	} 
   	
   	DynamitablePos.prototype = {   		   		
   		//initiation of table
   		initiation: function(thisTable,options) {
   			/**
   			 *  convert table to csv and multiSelect
   			 */   			   			
   			var dynamitablePos = this,
   				tableData = dynamitablePos.options.tableData,
   				noExportCSV = dynamitablePos.options.noExportCSV,
   				champs_alwaysExportCSV = dynamitablePos.options.champs_alwaysExportCSV,
   				ExportCSVSpec = dynamitablePos.options.ExportCSVSpec,
   				champs_noFilter = dynamitablePos.options.champs_noFilter,
   				selectData = tableData,
   				newline = '\n',
   				visibleColumn = [],
   				champsTitle = [],
   				is_asc = false,
   				filterDataResult = [],
   				start=0,
   				data2export,
   				$destElement = $(thisTable),
   				img_asc = "/img/asc_sort.gif",
   				img_desc = "/img/desc_sort.gif",
   				img_nosort = "/img/no_sort.gif",
   				dataFilter,
   				dataSort,
   				thisTable = $(thisTable);
   			// get the name of the local path, the name of page
   			var pageNameSplit=document.location.pathname.split('/', 3);
   			dynamitablePos.pageName=pageNameSplit.join("/").replace(/\/+$/, '');
   			dynamitablePos.tableName = thisTable.attr('id');
   			// get the value of tableController
   			if(options.tableController != null){
   				dynamitablePos.controller = options.tableController;
			}else{
				dynamitablePos.controller = pageNameSplit[1].toLowerCase();
			}   			
   			
   			var	tableName = dynamitablePos.tableName,
   				selector = '.js-filter',
   				filename = tableName + '.csv',
   				selectAllButton = "#" + tableName + "SelectAll",
   				selectNoneButton = "#" + tableName + "SelectNone",
   				selectInvertButton = "#" + tableName + "SelectInv",
   				selectVisibleButton = "#" + tableName + "SelectVisible",
   				selectInvertVisibleButton = "#" + tableName + "SelectInvertVisible",
   				csvOnePageId = "#" + tableName + "CsvOnePage",
   				csvSelectedId = "#" + tableName + "CsvSelected",
   				csvAllId = "#" + tableName + "CsvAll",   				
   				columnFilterContainerId = "#" + tableName + "ColumnFilter";
   			// for downloading the file csv 
   			// taken from http://stackoverflow.com/questions/3665115/create-a-file-in-memory-for-user-to-download-not-through-server
   			function download(filename, data) {
   				var blob = new Blob([data], {type: 'type: "text/csv;charset=UTF-8"'});
   				if(window.navigator.msSaveOrOpenBlob) {
   					window.navigator.msSaveBlob(blob, filename);
   				}
   				else{
   					var encodedUri = encodeURI(data);
   					var link = document.createElement("a");
   					link.setAttribute("href", "data:text/csv;charset=utf-8,\uFEFF" + encodedUri);
   					link.setAttribute("download", filename);
   					link.click();
   					
   					/*var elem = window.document.createElement('a');
   					elem.href = window.URL.createObjectURL(blob);
   					elem.download = filename;        
   					document.body.appendChild(elem);
   					elem.click();        
   					document.body.removeChild(elem);*/
   				}
   			}
   			
   			//get the title of each column
   			thisTable.find('th').each(function(){
   	        	champsTitle.push($(this).attr('name'));
   	        });
   			
   			//get the visible column
   			function getVisibleColumn(){
   				visibleColumn = [];
   				$(columnFilterContainerId).find('input.checkbox1').each(function(){				
   					var label = $(this).attr('name');
   					if($(this).is(':checked')){
   						visibleColumn.push(label);  						
   					}
   				});
   				return visibleColumn;
   			}   			
   			// bind the click event to these select buttons 
   			function bindSelectButton(){
   				$(selectAllButton).bind("click",function(){
   	   				selectAll();
   	   			});		
   	   			$(selectNoneButton).bind("click",function(){
   	   				selectNone();
   	   			});		
   	   			$(selectVisibleButton).bind("click",function(){
   	   				selectVisible();
   	   			});		
   	   			$(selectInvertButton).bind("click",function(){
   	   				selectInvert();
   	   			});		
   	   			$(selectInvertVisibleButton).bind("click",function(){
   	   				selectInvertVisible();
   	   			});
   			}	
   			
   			// bind the click event to these buttons about converting CSV
   			function bindCsvButton(){
   				$(csvOnePageId).bind("click",function(){
   	   				csvOnePage(getVisibleColumn());
   	   			});		
   	   			$(csvSelectedId).bind("click",function(){
   	   				csvSelected(getVisibleColumn());
   	   			});		
   	   			$(csvAllId).bind("click",function(){
   	   				csvAll(getVisibleColumn());
   	   			});
   			}
   			// delete all selected elements
   			function deleteAllSelected(){
   				$('#' + tableName + "delete").on('click',function(){
   	   				var idToDelete = [];
   	   				for (var values in selectData) {
   	   					if(selectData[values]['Checkbox'] == '1'){
   	   						idToDelete.push(selectData[values]['id']);
   	   					}	
   	   	        	}     				
   	   				$.ajax({
   	 	        		  method: "POST",
   	 	        		  url: "/"+ dynamitablePos.controller+"/doSomething",
   	 	        		  data: {"idToDelete" : idToDelete},
   	 	        		  dataType: "json",   	        		  
   	 	        		})
   	 	        		.done(function( msg ) {
   	 	        			  location.reload(true);
   	 	        		  });
   	 	        		
   	   			});
   			}   			
   			//export the table of the current page to CSV
   			function csvOnePage(visibleColumn){
   				initCSV(visibleColumn);
   				thisTable.find("tbody tr").each(function(){
   	        		var key=$(this).find('input[name=check]').attr('key');
   	        		if (key != undefined) {
   	        			generateCSV(key,visibleColumn);
   	        		}
   				});
   				download(filename, data2export);
   			}
   			//export the selected row to CSV
   			function csvSelected(visibleColumn){
   				initCSV(visibleColumn);
   				for (var values in selectData) {
   					if(selectData[values]['Checkbox'] == '1'){
   						generateCSV(values,visibleColumn);
   					}	
   	        	}
   				download(filename, data2export);
   			}
   			//export all of the table to CSV
   			function csvAll(visibleColumn){
   				initCSV(visibleColumn);
   				for (var values in selectData) {
   					generateCSV(values,visibleColumn);
   	        	}
   				download(filename, data2export);
   			}
   			//initialize the title of each column in the table
   			function initCSV(visibleColumn){
   				data2export = "";
   				// Add headers
   				for(var i=0; i<champsTitle.length; i++){
   					if (($.inArray(champsTitle[i],champs_alwaysExportCSV) != -1) || (($.inArray(champsTitle[i], noExportCSV) == -1) && (champsTitle[i]!="Checkbox") && (champsTitle[i]!="Actions") && (visibleColumn.indexOf(champsTitle[i]) != -1))) {
   						if (data2export.length==0) {
   							data2export+=champsTitle[i];
   						} else {
   							data2export+=";";
   							data2export+=champsTitle[i];
   						}
   					}   	
   				}
   				data2export += newline;
   				
   			}
   			//deal with these champs of each row
   			function generateCSV(key,visibleColumn) {
   				var csvtemp="";
   				for(var i=0; i<champsTitle.length; i++){
   					if (($.inArray(champsTitle[i],champs_alwaysExportCSV) != -1) || (($.inArray(champsTitle[i], noExportCSV) == -1) && (champsTitle[i]!="Checkbox") && (champsTitle[i]!="Actions") && (visibleColumn.indexOf(champsTitle[i]) != -1))) {
						if (csvtemp.length==0) {
							csvtemp+=selectData[key][champsTitle[i]];
   						} else {
   							var matchURL='<a.*?>.*</a>';
   				        	var regexURL = new RegExp(matchURL,'i');
   				        	if(regexURL.test(selectData[key][champsTitle[i]]) == true){
   			        			csvtemp += ";" + $(selectData[key][champsTitle[i]]).attr('value');
   			        		}else{

   	   							var tempData = ExportCSVSpec(selectData[key][champsTitle[i]], champsTitle[i]);
   	   							if(tempData)
   	   							{
   	   								csvtemp += ";" + tempData;
   	   							}
   	   							else
   								{
   	   								if(selectData[key][champsTitle[i]] != null && (typeof selectData[key][champsTitle[i]] == 'string' || selectData[key][champsTitle[i]] instanceof String))
   	   									selectData[key][champsTitle[i]] = selectData[key][champsTitle[i]].replace(/;/gi, ',').replace(/<br\/>/gi, ' - ').replace(/<br \/>/gi, ' - ');
   	   								else if(selectData[key][champsTitle[i]] == null || selectData[key][champsTitle[i]] == '')
   	   									selectData[key][champsTitle[i]] = ' - ';
   	   								csvtemp += ";" + selectData[key][champsTitle[i]];
   								}
   			        		}			           	 	
   						}
   					}
   				}
   				data2export += csvtemp;
   				data2export += newline;
   			}
   			//make all the row checked
   			function selectAll(){
   				for (var values in selectData) {
   					selectData[values]['Checkbox']='1';
   	        	}
   				thisTable.find("input[name=check]").each(function(){
   					$(this).prop('checked', true);
   				});
   	        	
   			};
   			//make all the row unchecked
   			function selectNone(){
   				for (var values in selectData) {
   					selectData[values]['Checkbox']='0';
   	        	}
   				thisTable.find("input[name=check]").each(function(){
   					$(this).prop('checked', false);
   				});   	        	
   			};
   			//make all the visible row checked
   			function selectVisible(){
   				thisTable.find("input[name=check]").filter(":visible").each(function(){
   					var key=$(this).attr('key');
   					selectData[key]['Checkbox']='1';
   					$(this).prop('checked', true);
   				});   	        	
   			};
   			//invert the checkbox
   			function selectInvert(){
   				for (var values in selectData) {
   					if (selectData[values]['Checkbox']=='1') {
   						selectData[values]['Checkbox']='0';
   					} else {
   						selectData[values]['Checkbox']='1';
   					}
   	        	}
   				
   				thisTable.find("input[name=check]").each(function(){
   					if(this.checked){
   						$(this).prop('checked', false);
   					}else{
   						$(this).prop('checked', true);
   					}
   				});    	        	
   			};
   			//invert the visible checkbox
   			function selectInvertVisible(){
   				thisTable.find("input[name=check]").filter(":visible").each(function(){
   	        		var key=$(this).attr('key');
   					if(this.checked){
   						selectData[key]['Checkbox']='0';
   						$(this).prop('checked', false);
   					}else{
   						selectData[key]['Checkbox']='1';
   						$(this).prop('checked', true);
   					}
   				});
   			}; 
   			//ini the variable Checkbox and his value in table data
   	        function initcheckbox(data) {
   	        	for (var values in data) {
   	        		data[values]['Checkbox']='0';
   	        	}
   	        }
   	                
   	        // ini the dynamitable        
   	        function  initTable(){             	
   	        	thisTable.find('tbody').empty();        	
   	        	initcheckbox(selectData);
   	        	dynamitablePos.paginate(start,tableData,options,thisTable); 
   	        	bindSelectButton();
   	        	bindCsvButton();
   	        	deleteAllSelected();
   	        }
   	        initTable();

   	        /**********************************************
   	         * dynamitableCore
   	         **********************************************/
   	        var dynamitableCore = new (function($thisTable) {

   	            /**********************************************
   	             * dynamitableCore.getIndex($field)
   	             *
   	             * get the index of a field
   	             *
   	             * return integer
   	             **********************************************/
   	            this.getIndex = function($field) {
   	                return $field.parents('tr').children('td, th').index($field);
   	            };

   	            /**********************************************
   	             * dynamitableCore.getBody()
   	             *
   	             * get the body of the table
   	             *
   	             * return dom
   	             **********************************************/
   	            this.getBody = function() {
   	                return $thisTable.find('tbody');
   	            };

   	            /**********************************************
   	             * dynamitableCore.getRows()
   	             *
   	             * get all row inside the body of the table
   	             *
   	             * return dom
   	             **********************************************/
   	            this.getRows = function() {
   	                return this.getBody().children('tr');
   	            };

   	            /**********************************************
   	             * dynamitableCore.getField(index, $row)
   	             *
   	             * get a field
   	             *
   	             * return dom
   	             **********************************************/
   	            this.getField = function(index, $row) {
   	                return $row.children('td, th').eq(index);
   	            };

   	            /**********************************************
   	             * dynamitableCore.getValue(index, $row)
   	             *
   	             * get a field value
   	             *
   	             * return string
   	             **********************************************/
   	            this.getValue = function(index, $row) {
   	                return this.getField(index, $row).text();
   	            };
   	        })($(this));

   	        /**********************************************
   	         * dynamitable.filterList
   	         *
   	         * list of filter selector
   	         *
   	         * array of string
   	         **********************************************/
   	        var filterList = [];
  	       
   			// reconstruct string
   	        function reconstructString(i,string){
   	        	var specialChars = "<>@!#$%^&*()_+[]{}?:;|'\"\\,./~`-=";
   	        	var newMatches = "";
   	        	for(i; i < string.length; i++){   	        				
	        		if(specialChars.indexOf(string.charAt(i)) > -1){
	        			var str = "\\";
	        			str += string.charAt(i);
	        			newMatches += str;
	        		}else{
	        			newMatches += string.charAt(i);
	        		}
	        	} 
   	        	return newMatches;
   	        } 
   	        // reset the icon of sort
   	        function resetSortImage(){
   	        	$("th", $destElement).each(function(index){            	   	            	
	            	if(($(this).attr('name') != "Checkbox") && ($(this).attr('name') != "Actions")){
	        				$(".sorttable_img", $destElement).attr('src', img_nosort); 	
	        			}
	            });
   	        }
	        // filter the data
   	        function filterData(){
   	        	$(thisTable).find(selector).each(function(){
   	        		var $this = $(this),
   	        			index = dynamitableCore.getIndex($this.parent('th')), 							
   	        			key = $this.parent('th').attr('name'),	
   	        			matches = $this.val(),
   	        			matchURL='<a.*?>',
   	        			matchstring="",
   	        			regexURL = new RegExp(matchURL,'i'); 
   	        		var newMatches="",
   	        			inverse = false;

   	        		if(matches.charAt(0) == "!"){
   	        			inverse = true;
   	        			matchstring = reconstructString(1,matches);
   	        		}else{
   	        			matchstring = reconstructString(0,matches);
   	        		}  	        		 
   	        		// stock the input of each filter
   	        		sessionStorage.setItem(tableName + key, matches);
   	        		var i = dataFilter.length;
   	        		while (i--){
   	        			var comparedata = dataFilter[i][key];
   	        			if(regexURL.test(comparedata) == true){
  	           				matchstring='<a.*?>(.*?)' + matchstring + '(.*?)<\/a>';
 	           			}
   	        			var regex = new RegExp(matchstring,'i');
   	        			if(inverse == true){
   	        				if (regex.test(comparedata) == true){
   	   	        				dataFilter.splice(i,1);
   	   	        				selectData = dataFilter;
   	   	        			}
   	        			}else{
   	        				if (regex.test(comparedata) !== true){
   	   	        				dataFilter.splice(i,1);
   	   	        				selectData = dataFilter;
   	   	        			}
   	        			}
   	        			
   	        		}	
   	        	});	
   	        }
   	        // filter the table
   	        function filter(selector) {
   	        	thisTable.find('tbody').empty(); 
   	        	dataFilter = tableData.slice(0);
   	        	resetSortImage();
   	        	filterData();
   	           	dynamitablePos.paginate(start,dataFilter,options,thisTable);
   	            return this;
   	        };
   	        

   	        /**********************************************
   	         * dynamitable.addFilter(selector)
   	         *
   	         * add filter event on element inside the table heading
   	         *
   	         * - selector (string) : selector of the element that trigger the event
   	         **********************************************/
   	        function addFilter(selector) {
   	            // add the selector to the filter list
   	        	filterList.push(selector);   	        	
   	            // ini filter
   					$(filterList).each(function(index, selector) {
   						$(thisTable).find(selector).each(function() {
   							var key = $(this).parent('th').attr('name');	
   							if(sessionStorage.getItem(tableName + key) != null && sessionStorage.getItem(tableName + key) != undefined){
   								filter(selector);
   			                }
   							var timer, delay = 1000;
   			                $(this).bind('keyup', function(e) {
   			                	clearTimeout(timer);   			                	
   			    			    timer = setTimeout(function() {filter(selector)}, delay );	
   			               	}); 
   			                
   						});		
   					});			
   				return this;
   	        };

   	        // add sort and filter 
   	        function addSortAndFilter(){
   	   	        $("th", $destElement).each(function(index){   
   	   	        	if($.inArray($(this).attr('name'), champs_noFilter) == -1)
   	        		{
	   	   	            var index = dynamitableCore.getIndex($(this));
	   	   	            var key = champsTitle[index];
	   	   	            if(($(this).attr('name') != "Checkbox") && ($(this).attr('name') != "Actions")){
	   	   	            	$("<img>")
	   	   	        		.attr('src', img_nosort)
	   	   	        		.addClass('sorttable_img')
	   	   	        		.on('click', function(){
	   	   	        			$(".sorttable_img", $destElement).attr('src', img_nosort);     	        				
	   	   	        			$(this).attr('src', (is_asc) ? img_desc : img_asc);
	   	   	        			block();
	   	   	        			$("th", $destElement).each(function(index){
	   	   	        				var index1 = dynamitableCore.getIndex($(this));
	   	   	        	            var key1 = champsTitle[index1];
	   	   	        	            sessionStorage.setItem(key1, "");
	   	   	        			})
	   	   	        			sessionStorage.setItem(key, is_asc);
	   	   	        			var id=setTimeout(function() { sorter(key, is_asc); is_asc = !is_asc;}, 200);
	   	   	        		})
	   	   	        		.appendTo(this);
	   	   	            	if(sessionStorage.getItem(tableName + key) != null && sessionStorage.getItem(tableName + key) != undefined){
	   	   	            		$('<input class="js-filter  form-control" type="text" value="'+sessionStorage.getItem(tableName + key) +'">')
	   	   	   	        		.appendTo(this);
	   	   	            	}else{
	   	   	            		$('<input class="js-filter  form-control" type="text" value="">')
	   	   	   	        		.appendTo(this);
	   	   	            	}	
   	   	            	}
   	   	            }
   	   	        });
   	   	        	addFilter(selector);
   	   	       
   	        }
   	        
   	        if(options.champsNoFilterASort != true){
   	        	addSortAndFilter();
   	        }
   	        
   	        // get the name of the first visible column 
   	        function getNameOfFirstColumn(){
   	        	var name;
   	        	var count = 0;
   	        	$("#" + tableName + "ColumnFilter").find('input.checkbox1').each(function(){
   	        		if(count == 0){
   	        			if($(this).is(':checked')){
   	        				count++;
   	        				name = $(this).attr('name');
   	        				return false;
   	   	        		}
   	        		}
   	        	});
   	        	return name;
   	        }
   	        
   	        //check whether has the session about sort
   	        function getSessionKeyOfSort(){
   	        	var keySort;
   	        	$("th", $destElement).each(function(index){            	
   	   	        	var index = dynamitableCore.getIndex($(this));
   	   	        	var key = champsTitle[index];
   	   	        	if(sessionStorage.getItem(key) != "" && sessionStorage.getItem(key) != undefined){
   	   	        		keySort = key;
   	   	        		return false;
   	   	        	}
   	   	        });
   	        	return keySort;
   	        }
   	        
   	        // sort by session
   	        function sortBySession(){
   	        	$("th", $destElement).each(function(index){            	
	   	            var index = dynamitableCore.getIndex($(this));
	   	            var key = champsTitle[index];
	   	            if(key == getSessionKeyOfSort()){
	   	            	if(sessionStorage.getItem(key) == "true"){
	   	            		is_asc = true;
	   	            	}
	   	            	else{
	   	            		is_asc = false;
	   	            	}
	   	            	$(".sorttable_img", $destElement).attr('src', img_nosort);
	   	            	$(this).find("img").attr('src', (!is_asc) ? img_asc : img_desc); 
	   	            	block();
	   	       			var id = setTimeout(function() { sorter(key, is_asc); is_asc = !is_asc;}, 200);
	   	       			return false;
	   	            }
   	        	});
   	        }
   	        
   	        // sort by the first visible column
   	        function sortByFirstVisColumn(){
   	        	$("th", $destElement).each(function(index){            	
	   	            var index = dynamitableCore.getIndex($(this));
	   	            var key = champsTitle[index];
	   	            if(key == getNameOfFirstColumn()){
	   	            	$(".sorttable_img", $destElement).attr('src', img_nosort);
	   	                $(this).find(".sorttable_img").attr('src', (!is_asc) ? img_asc : img_desc); 
	   	                block();
	   	                var id = setTimeout(function() { sorter(key, is_asc); is_asc = !is_asc; }, 200);
	   	               	return false;
	   	            }		
   	        	});
   	        }
   	        // ini the sort (if the key of session about sort exists, sort by the key; else sort by the first visible column)
   	        function iniSort(){

   	        	if(getSessionKeyOfSort() != undefined){
   	        		sortBySession();
   	   	        }else{
   	   	        	sortByFirstVisColumn();
   	   	        }
   	        } 
   	        iniSort();
   	        // sort the table 
   	        function sorter(key, order) {   
   	        	thisTable.find('tbody').empty();
   	        	var dataSort = [];
   	        	if(dataFilter == undefined){
   	        		dataSort = tableData.slice(0);
   	        	}
   	        	else{
   	        		dataSort = dataFilter.slice(0);  
   	        	}    
   	   	     	
   	   	     	// sort the array dataSort
   	   	     	dataSort.sort(naturalSort);
   	   	     	dataSort.sort(function(a,b){
   	   	     		return naturalSort(a[key],b[key], { insensitive: true, desc: order })
   	   	     	});
   	   	     	
   	   	     	selectData = dataSort;
   	   	     	// create HTML
   	   	     	dynamitablePos.paginate(start, dataSort,options, thisTable);
   	   	     	unblock();
   	   	     	return this;    
   	   	     	
   	   	     	
   	        	/*
   	   	      	* Natural Sort algorithm for Javascript - Version 0.8.1 - Released under MIT license
   	   	      	* Author: Jim Palmer (based on chunking idea from Dave Koelle)
   	   	      	*/
   	   	     	function naturalSort (a, b, options) {
			   	   	   var re = /(^-?[0-9]+(\.?[0-9]*)[df]?e?[0-9]?$|^0x[0-9a-f]+$|[0-9]+)/gi,
			   	       sre = /(^[ ]*|[ ]*$)/g,
			   	       dre = /(^([\w ]+,?[\w ]+)?[\w ]+,?[\w ]+\d+:\d+(:\d+)?[\w ]?|^\d{1,4}[\/\-]\d{1,4}[\/\-]\d{1,4}|^\w+, \w+ \d+, \d{4})/,
			   	       hre = /^0x[0-9a-f]+$/i,
			   	       ore = /^0/,
			   	       options = options || {},
			   	       i = function(s) { return options.insensitive && (''+s).toLowerCase() || ''+s },
			   	       // convert all to strings strip whitespace
			   	       x = i(a).replace(sre, '') || '',
			   	       y = i(b).replace(sre, '') || '',
			   	       // chunk/tokenize
			   	       xN = x.replace(re, '\0$1\0').replace(/\0$/,'').replace(/^\0/,'').split('\0'),
			   	       yN = y.replace(re, '\0$1\0').replace(/\0$/,'').replace(/^\0/,'').split('\0'),
			   	       //Convert date to american format (Date.parse take only mm/dd/yyyy)
			   	       
			   	       // numeric, hex or date detection
			   	       xD = parseInt(x.match(hre)) || (xN.length !== 1 && x.match(dre) && Date.parse(moment(x, "DD/MM/YYYY"))),
			   	       yD = parseInt(y.match(hre)) || xD && y.match(dre) && Date.parse(moment(y, "DD/MM/YYYY")) || null,
			   	       oFxNcL, oFyNcL,
			   	       mult = options.desc ? -1 : 1;
			   	     // first try and sort Hex codes or Dates
			   	     if (yD)
			   	       if ( xD < yD ) return -1 * mult;
			   	       else if ( xD > yD ) return 1 * mult;
			   	     // natural sorting through split numeric strings and default strings
			   	     for(var cLoc=0, numS=Math.max(xN.length, yN.length); cLoc < numS; cLoc++) {
			   	       // find floats not starting with '0', string or 0 if not defined (Clint Priest)
			   	       oFxNcL = !(xN[cLoc] || '').match(ore) && parseFloat(xN[cLoc]) || xN[cLoc] || 0;
			   	       oFyNcL = !(yN[cLoc] || '').match(ore) && parseFloat(yN[cLoc]) || yN[cLoc] || 0;
			   	       // handle numeric vs string comparison - number < string - (Kyle Adams)
			   	       if (isNaN(oFxNcL) !== isNaN(oFyNcL)) { return (isNaN(oFxNcL) ? 1 : -1) * mult; }
			   	       // rely on string comparison if different types - i.e. '02' < 2 != '02' < '2'
			   	       else if (typeof oFxNcL !== typeof oFyNcL) {
			   	         oFxNcL += '';
			   	         oFyNcL += '';
			   	       }
			   	       if (oFxNcL < oFyNcL) return -1 * mult;
			   	       if (oFxNcL > oFyNcL) return 1 * mult;
			   	     }
			   	     return 0;
   	   	     	} //end natural sort
   	        } 
   		},
   		// hide or show the column
   		columnFilter: function(options,thisTable) {
   			
   			var columnFilter = this,
   				pageName = columnFilter.pageName,
				tableName = columnFilter.tableName;
   			
   			var	headerCell = 'TH',
   				columnCheckboxsContainer =  "#" + tableName + "ColumnFilter",
   				columnList = '',   				
   				checked='',
   				tableChamps = [],
   				parameterId = "null",
   	        	userId,
   	        	paraTable,
   	        	paraPage = "",
   	        	columnHidden =[],
   	        	champs_alwaysHidden = [],
   	        	parameterTable,
   	        	userId = this.options.userId,
   				parameterData = this.options.parameterData;   
   			
   			if(this.options.champs_alwaysHidden != undefined){
   				champs_alwaysHidden = this.options.champs_alwaysHidden
   			}
   			// ini the title of each column
   			function iniTitle(){
   				thisTable.find('th').each(function(){
   	   	        	if($(this).text()!="" && $(this).text()!="Actions"){
   	   	        		tableChamps.push([$(this).text(),$(this).attr('name')]);
   	   	        	}
   	   	        });
   			}
   	        // ini data
   			function iniData(){
   				// ini the information of parameter
   				if(!(parameterData == "")){  
   					for(var i=0; i<parameterData.length; i++){
   						if(tableName == parameterData[i]['table_name']){
   							parameterTable = parameterData[i];
   							parameterId = parameterTable['id'];
   		   	   	        	userId = parameterTable['user_id'];
   		   	   	        	paraPage = parameterTable['para_page'];
   		   	   	        	paraTable = parameterTable['para_table'];
   		   	   	        	columnHidden = JSON.parse(paraTable); 
   						}
   					}	
   				}
   				iniTitle();
   			}
   			
   			// add choice
   	        function addColumn(champName, checked, disabled, hidden){
   	        	var checkbox = '<input name="' + champName[1] + '"class="checkbox1" type="checkbox" '+ checked + disabled +' label="'+ champName[0] +'">';
   				columnList = '<li ' + hidden + '>'+checkbox + ' ' + champName[0] +'</li>';
   				$(columnCheckboxsContainer).find(".dropdownMenuWithScroll").append(columnList);
   	        }
   	        
   	        // initiation of the columnFilter
   	        function init(){
   	        	iniData();
   	        	$(columnCheckboxsContainer).find(".dropdownMenuWithScroll").find('li').each(function(){
   	        		$(this).remove();
   	        	})
   	        	var saveButton;   	        	
				saveButton = '<li><button type="button" class="save" id="' + tableName + 'Parameters">Save in your profile'
							+ '</button></li>';
				$(columnCheckboxsContainer).find(".dropdownMenuWithScroll").append(saveButton);
   	            for(var i=0; i<tableChamps.length; i++)	{
   	            	if(champs_alwaysHidden.indexOf(tableChamps[i][1]) != -1){
   	            		addColumn(tableChamps[i], "", 'disabled="disabled"', "hidden");
   	            	}else if(columnHidden.indexOf(tableChamps[i][1]) != -1 ){
   	            		addColumn(tableChamps[i], "", "", "");
   	            	}else{
   	            		addColumn(tableChamps[i], "checked", "", "");
   	            	}
   	            }
   	            $(columnCheckboxsContainer).find('input.checkbox1').each(function(){
   	              var label = $(this).attr('name');
   	              var index = thisTable.find('thead tr th').filter(function() {
   	            	  return $(this).attr('name') == label;
   	              }).index();
   	              
   	              if( !$(this).is(':checked') ) {
   	                  thisTable.find('thead').children().each(function(i){
   	                      $(this).children().eq(index).hide();
   	                  });
   	                  thisTable.find('tbody').children().each(function(i){
   	                      $(this).children().eq(index).hide();
   	                  });
   	              }else{
   	                  thisTable.find('thead').children().each(function(i){
   	                      $(this).children().eq(index).show();
   	                  });                                
   	                  thisTable.find('tbody').children().each(function(i){
   	                      $(this).children().eq(index).show();
   	                  }); 
   	              }
   	          });
   	        }
   	        
   	        init();
   	        
   	        //get all of the checked checkbox   	        
   	        function getCheckboxChecked(){
   	        	var checkboxChecked = [],
   	        		dataSent = {};
   	        	$(columnCheckboxsContainer).find('input.checkbox1').each(function(){
   	        		if(!$(this).is(':checked')){
   	        			checkboxChecked.push($(this).attr('name'));
   	        		}
   	        	});
   	        	if(parameterTable !== undefined){
   	        		dataSent['id'] = parameterId;
   	        	}  	        	   	        	  	        	
   	        	dataSent['user_id'] = userId;
   	        	dataSent['table_name'] = tableName; 
   	        	dataSent['page_name'] = pageName;
   	        	dataSent['para_page'] = paraPage;
   	        	dataSent['para_table'] = JSON.stringify(checkboxChecked);  	        	
   	        	return dataSent;
   	        }
   	        // save the hiding column informations
   	        $("#" + tableName + "Parameters").on('click', function() {
   	        	$.ajax({
   	        		  method: "POST",
   	        		  url: "/"+ "parameters"+"/changeTablePara?" +"parameterId=" + parameterId,
   	        		  data: getCheckboxChecked(),
   	        		  dataType: "json",   	        		  
   	        		})
   	        		  .done(function() {
   	        			  location.reload(true);
   	        		  });
   	      	});        
   	        // choose to show or hide the column
   	        $(columnCheckboxsContainer).find('input.checkbox1').bind('click', function(){
   	            var label = $(this).attr('name');
   	            var index = thisTable.find('thead tr th').filter(function() {
   	                return $(this).attr('name') == label;
   	            }).index();
   	            if( !$(this).is(':checked') ) {
   	                thisTable.find('thead').children().each(function(i){
   	                    $(this).children().eq(index).hide();
   	                });
   	                thisTable.find('tbody').children().each(function(i){
   	                    $(this).children().eq(index).hide();
   	                });            
   	            } else { 
   	                thisTable.find('thead').children().each(function(i){
   	                    $(this).children().eq(index).show();
   	                });                                
   	                thisTable.find('tbody').children().each(function(i){
   	                    $(this).children().eq(index).show();
   	                });
   	            }
   	        });
   	        return;
   		},
   		
   		// edit, delete, save in the table
   		editable: function(controller,options,thisTable){
   			var editable = this,
   				controller = controller,
   				editAction = editable.options.editAction,
   				deleteAction = editable.options.deleteAction,
   				keyboard = editable.options.keyboard,
   				dblclick = editable.options.dblclick,
   				DbClickEventFilter = editable.options.DbClickEventFilter,
   				ExportCSVSpec = editable.options.ExportCSVSpec,
   				button = editable.options.button,
   				buttonSelector = editable.options.buttonSelector,
   				buttonCancel = editable.options.buttonCancel,
   				buttonRemove = editable.options.buttonRemove,
   				maintainWidth = editable.options.maintainWidth,
   				dropdowns = editable.options.dropdowns,
   				dropdownsAccesses = editable.options.dropdownsAccesses;
   			// deal with the data by each row
   			if(editable.options.isEdit == true){
   				thisTable.find('.data').each(function(){
   	   				var thisRow = this;
   	   				
   	   				function _captureEvent(e) {
   	   					e.stopPropagation();
   	   				}
   	   				function _captureKey(e) {
   	   					if (e.which == 13) {
   	   						save();
   	   						editing = false;
   	   					} else if (e.which == 27) {
   	   						editing = false;
   	   						cancel();  
   	   		           }
   	   				}
   	   				
   	   				
   	   				// edit in the table
   	   				function edit() {
   	   					$(".edit i", thisRow)
   	   						.removeClass('fa-pencil-square-o')
   	   						.addClass('fa-floppy-o')
   	   						.attr('title', 'Save');
   	   					var values = {};
   	   					var id;
   	   					// get id
   		   	            $('td[data-id]', thisRow).each(function() {
   		   	            		id = $(this).attr('old');
   		   	            });
   		   	            //ajax of members succeeds
   		   	            function membersSucceeds(oldModele, input, data){
   		   	            	var choice = data;
			 	       			for (var key in choice) {
			 	       				for(var value in choice[key]){
			 	       					var option;
			 	       					if(oldModele == choice[key][value]){
			 	       						option = $('<option selected == "selected" key="' + value + '" value="'+ choice[key][value] +'"></option>');
			 	       					}else{
			 	       						option = $('<option key="' + value + '" value="'+ choice[key][value] +'"></option>')   				 	       					
			 	       					}
			 	       					option
			 	       						.text(choice[key][value])
			 	       						.appendTo(input);
			 	       				}   	   									
			 	       			} 
   		   	            }
   		   	            
   		   	            // ajax of extension succeeds
   		   	            function extensionSucceeds(extension_modele, i, thisColumn, data){
   		   	            	for(var j in data){  
									var input = $('<select id="' + i + '"></select>');
									for(var key in data[j]){
										var	option;  
			 	       						if(extension_modele == data[j][key]){
			 	       							option = $('<option selected == "selected" key="' + key + '" value="'+ data[j][key] +'"></option>');
			 	       						}else{
			 	       							option = $('<option key="' + key + '" value="'+ data[j][key] +'"></option>')   				 	       					
			 	       						}
			 	       						option
			 	       							.text(data[j][key])
			 	       							.appendTo(input);
		 	       					} 
									input.appendTo(thisColumn);
									if (keyboard) {
			   								input.keydown(_captureEvent.bind(thisRow));
			   							}
								} 
   		   	            }
   		   	               		   	           
   		   	            // deal with the editable champ
   		   	            function multiDropdown(){   		   	            	
   	   	   					$('td[data-field]', thisRow).each(function() {
   	   	   						var thisColumn = this,
   	   	   							field = $(this).data('field'),
   	   	   		                   	value = $(this).text(),
   	   	   		                   	width = $(this).width();  
   	   	   						 
   	   	   						var choice;
   	   	   						values[field] = value;
   	   	   						$(this).empty();
   	   	   						if (maintainWidth) {
   	   	   							$(this).width(width);
   	   	   						}
   	   	   						if (field in dropdowns) {
   	   	   							// deal with the dropdown
   	   	   							if($(this).hasClass('special')){
   	   	   								var oldModele = $(this).attr('old');
   	   	   							// for dealing with the special situation  of the page cards.ctp    								
   	   	   								var input = $('<select ></select>');   								
   	   	   								$.ajax({
   	   	   				 	       			method: "GET",
   	   	   				 	       			url: "/membres/edit/" + id,
   	   	   				 	       			dataType: "json",
   	   	   				 	       			beforeSend: block,
   	   	   				 	       			complete: unblock,
   	   	   				 	       			async: true
   	   	   				 	       		})
   	   	   				 	       		.done(function(data) {
   	   	   				 	       			membersSucceeds(oldModele,input,data);
   	   	   				 		        });
   	   	   								input.appendTo(this);
   	   	   								if (keyboard) {
   	   	   		   							input.keydown(_captureEvent.bind(thisRow));
   	   	   		   						}
   	   	   								
   	   	   							}else if($(this).hasClass('extension')){
   	   	   								
   	   	   								// for dealing with the special situation  of the page cards.ctp 
   	   	   								if($(this).attr('extension_id') != undefined){
   	   	   									var extension = $(this).attr('extension_id'),
   	   	   										extension_id = [];
   	   	   									extension_id = extension.split('/'); 
   	   	   									var modele = $(this).attr('modele_extension'),
   	   	   										Modele_Extension = [];
   	   	   									Modele_Extension = modele.split('/');
   	   	   									var extension_modele;
   	   	   									for(var i in extension_id){
   	   	   										var	extension_modele = Modele_Extension[i];
   	   	   										$.ajax({
   	   	   											method: "GET",
   	   	   											url: "/extensions/edit/" + extension_id[i],
   	   	   											dataType: "json", 
   	   	   											async : false
   	   	   										}) 
   	   	   										.done(function(data) { 
   	   	   											extensionSucceeds(extension_modele, i, thisColumn, data);
   	   	   										})
   	   	   									}
   	   	   								}
   	   	   							}else{
   	   	   								var input = $('<select ></select>');
   	   	   	   							for (var key in dropdowns[field]) {
   	   	   	   								$('<option value="'+ key +'"></option>')
   	   			                            	.text(dropdowns[field][key])
   	   			                            	.appendTo(input);
   	   	   	   							};
   	   	   	   							input.val(value)
   	   	   	   								.data('old-value', key)
   	   	   	   								.dblclick(_captureEvent);
   	   	   	   							input.appendTo(this);
   	   	   	   							if (keyboard) {
   	   	   	   								input.keydown(_captureEvent.bind(thisRow));
   	   	   	   							}
   	   	   	   						}  	   													
   	   	   						}else{
   	   	   							if($(this).attr('len') != undefined){
   	   	   								input = $('<input maxlength="'+ $(this).attr('len') + '" type="text"/>');
   	   	   							}else{
   	   	   								input = $('<input type="text"/>');
   	   	   							}
   	   	   							input
   	   	   		                       	.val(value)
   	   	   		                       	.data('old-value', value)
   	   	   		                       	.dblclick(thisRow._captureEvent)
   	   	   								.on('keyup', function(e){
   	   	   									if(e.keyCode == 13){
   	   	   										save();
   	   	   				   						editing = false;
   	   	   									}
   	   	   									if(e.keyCode == 27){
   	   	   										canceller();
   	   	   									}   										
   	   	   								});
   	   	   							input.appendTo(this);
   	   	   							if (keyboard) {
   	   	   	   							input.keydown(_captureEvent.bind(thisRow));
   	   	   	   						}
   	   	   						}					
   	   	   					});
   	   	   				}
   		   	            multiDropdown();
   	   					
   	   				};
   	   				// save the modification
   	   	           	function save() {
   	   	           		$(".edit i", thisRow)
   	   	           			.removeClass('fa-floppy-o')
   	   	           			.addClass('fa-pencil-square-o')
   	   	           			.attr('title', 'Edit');
   	   	           		var	values = {old:{}};
   	   	           		$('td[data-id]', thisRow).each(function() {
   	   	           			values['id'] = $(this).attr('old');
   	   	           		}); 
   	   	           	// when ajax successes	
   	   	           		function success(data){
   	   	           			for(var i=0; i<editable.tableData.length; i++){
   	   	           				if(editable.tableData[i]['id'] == values["id"]){
   	   	           					var data = editable.tableData[i],
   	   	           						row = thisRow; 
   	   	           					$('td[data-field]', thisRow).each(function() {
   		           						var field = $(this).data('field');   	           				
   		           						$(this).attr("old",values[field]);
   		           						editable.tableData[i][field] = values[field]; 
   		           						if($(this).attr('extension_id')){
   		  									$(this).removeAttr('extension_id');      	            					
   		           						}
   		           						if($(this).attr('modele_extension')){
   											$(this).removeAttr('modele_extension');      	            					
   		           						}
   		           					});
   	   	           					if(options.callbackFunction){
   	   	           						options.callbackFunction(row, data);   	           						
   	   	           					}           					
   	   	           				}
   		           			}   	
   		           		}
   		           		function fail(data){
   		           			cancel();
   		           			if(data.responseJSON["code"] == 403)
   		           			{
	   		           			swal({
		   	   	   				  title: 'Erreur !',
		   	   	   				  html: JSON.stringify(data.responseJSON["message"]),
		   	   	   				  type: 'error'
		   	   	   				}).catch(swal.noop);
   		           			}
   		           			else
   		           			{
	   		           			edit();
	   		           			editing = true;
	   		           			cancelling = true;   	           			
	   		           			$('td[data-field]', thisRow).each(function() {
	   		           				var errorData = JSON.parse(data.responseJSON["message"]);
	   		           				var field = $(this).data('field');
	   		           				for (var nameColumnError in errorData){
	   		           					for(var nameColumn in errorData[nameColumnError] ){
	   		           						if(field == nameColumnError){
	   		           							$(this).find('input').addClass("form-input");
	   				   	   	                 	swal({
	   					   	   	   				  title: 'Erreur !',
	   					   	   	   				  html: errorData[nameColumnError][nameColumn],
	   					   	   	   				  type: 'error'
	   					   	   	   				}).catch(swal.noop);
	   		           							$(this).append('<small class="validation">'+"Error : "+ errorData[nameColumnError][nameColumn]+"!"+'</small>');  
	   		           						}
	   		           					}
	   		           				} 
	   		           				if($(this).attr('extension_id')){
	   	  									$(this).removeAttr('extension_id');      	            					
	   	  							}
	   		           				if($(this).attr('modele_extension')){
	   										$(this).removeAttr('modele_extension');      	            					
	   								}
	   		           			});  
   		           			}
   		           		}
   		           		
   		           		// check whether it has special situation (edit in model or extension )
   		           		
   		           		function checkSpecialSituation(){
   		           			var special = false;
   		           			$('td[data-field]', thisRow).each(function() {
   			           			if($(this).hasClass('special')){
   			           				special = true;	
   			           				return false
   			           			}
   			           		});
   		           			return special;
   		           		}
   		           		// deal with the special situation (if it is about extension or model)
   		           		function doAjaxForModAndExt(){
   		           			$('td[data-field]', thisRow).each(function() {
		   	           			// if it's the special situation
		   	           			if($(this).hasClass('special')){   	           				
		   	           				var thisColumn = this;
		   	           				var value,
		   	           					field = $(thisColumn).data('field');
		   	           				value = $(thisColumn).find('select').find('option:selected').text();
		   	           				// if the modele has been changed
		   	           				if($(thisColumn).attr("old") != value){
		   	           					var modele_id = $(thisColumn).find('select').find('option:selected').attr('key');  
		   	           					$.ajax({
		          							method: "POST",
		          							url: "/membres/edit/" + values['id'],
		          							data: {'modele_id' : modele_id},
		          							dataType: "json", 
		          						}) 
		          						.done(function(data) {   	           			
		          							success(data); 
		          							location.reload(true);
		          						})
		          						.fail(function(data) {
		          							fail(data);
		          						});
		          						$(this).empty()
		          							.text(value);          						
		   	           				}else{
		   	           					// if the modele has not been changed
		   	           					$(thisRow).find('.extension').each(function(){
		   	           						var thisColumn = this;
		   	           						if($(thisColumn).attr('extension_id') != undefined){
		   	           							var extension = $(thisColumn).attr('extension_id'),
		   	           								extension_id = [];
		   	           							extension_id = extension.split('/'); 
		   	           							$(thisColumn).find('select').each(function(){
		   	           								var select_id = $(this).attr('id');
		   	           								var	id = extension_id[select_id];
		   	           								var modele_id = $(this).find('option:selected').attr('key');
		   	           								$.ajax({
		   	           									method: "POST",
		   	           									url: "/extensions/edit/" + id,
		   	           									data: {'modele_id' : modele_id},
		   	           									dataType: "json", 
		   	           								}) 
		   	           								.done(function(data) {   	           			
		   	           									success(data);
		   	           									location.reload(true);
		   	           								})
		   	           								.fail(function(data) {
		   	           									fail(data);
		   	           								});
		   	           								$(this).empty()
		   	           								.text(value);
		   	           							});  
		   	           						}	   	           						
		   	           					}); 
		   	           				}   	           			
		   	           			}
		   	           		});
   		           		}
   		           		
   		           		// deal with the common situation
   		           		function doAjaxForCommon(){
   		           			$('td[data-field]', thisRow).each(function(){
		           				var field = $(this).data('field');
	   	           				var value = $(':input', this).val();
	   	           				values[$(this).data('field')] = value;
	   	           				var oldValue = $(this).attr('old');
	   	           				values.old[$(this).data('field')] = oldValue;
	   	           				$(this).empty()
	   	           					.text(value);
		           			}) 
	   	           			$.ajax({
	   	           				method: "POST",
	   	           				url: "/"+controller+"/" + editAction +"/" + values["id"],
	   	           				data: values,
	   	           				dataType: "json", 
	   	           			}) 
	   	           			.done(function(data) {   	           			
	   	           					success(data);         			
	   	           			})
	   	           			.fail(function(data) {
	   	           				fail(data);
	   	           			});
   		           		}
   		           		
   		           		if(checkSpecialSituation()){
   		           			doAjaxForModAndExt();
   		           		}else{	
   		           			doAjaxForCommon();
   	   	           		}
   	   	           	};   	           
   	   	           	// cancel the editable operation
   	   	            function cancel() {
   	   	            	$(".edit i", thisRow)
   	   	            		.removeClass('fa-floppy-o')
   	   	            		.addClass('fa-pencil-square-o')
   	   	            		.attr('title', 'Edit');
   	   	            	var id;
   	   	            	
   	   	            	var valuesOrigin = {};
   	   	            	$('td[data-field]', thisRow).each(function() {
   	   	            			var field = $(this).data('field');   	            		
   	   	            			var value = $(this).attr('old');
   	   	            			valuesOrigin[$(this).data('field')] = value;
   	   	            			$(this).empty()
   	   	                         	.text(value);
   	   	            			if($(this).attr('extension_id')){
   	   	            				$(this).removeAttr('extension_id');
   	   	            			}
   	   	            			if($(this).attr('modele_extension')){
	   	            				$(this).removeAttr('modele_extension');
	   	            			}
   	   	            	});
   	   	            	$('td[data-id]', thisRow).each(function() {
   	   	            		id = $(this).text();
   	   	            	});
   	   	            	for(var i=0; i<editable.tableData.length; i++){
   		           			if(editable.tableData[i]['id'] == id){
   		           				var data = editable.tableData[i],
   		           					row = thisRow;   	           					
   		           				if(options.callbackFunction){
   		           					options.callbackFunction(row, data);   	           						
   		           				} 
   		           			}
   		           		}      					   	            	
   	   	            }; 
   	   	            // delete an element
   	   	            function remove(){   	            	
   	   	            	var id;
   	   	            	$('td[data-id]', thisRow).each(function() {
   	   	            			id = $(this).attr('old');
   	   	            	});   	            	
   	   	            	if(confirm("Are you sure you want to delete the "+ controller +" id: "+id)){
   	   	            		$.ajax({
   	   	            			method: "POST",
   	   	            			url: "/"+controller+"/" + deleteAction + "/" + id,
   	   	            			dataType: "json", 
   	   	                 		}) 
   	   	                 		.done(function() {
   	   	                 			location.reload(true);
   	   	                 		})
   	   	                 	  	.fail(function(data) {
   	   	                 	  		cancel();
		   	   	                 	swal({
			   	   	   				  title: 'Erreur !',
			   	   	   				  html: JSON.stringify(data.responseJSON["message"]),
			   	   	   				  type: 'error'
			   	   	   				}).catch(swal.noop);
   	   	                 	  	})
   	   	            	}        	        	
   	   	            }
   	   	            
   	   	            var editing = false,
   	   	            	cancelling = false,
   	   	            	success =false;
   	   	            if (dblclick) {
   	   	            	if(DbClickEventFilter(thisRow)){
   	   	   	            	$(thisRow)
   	   	   	            		.css('cursor', 'pointer')
   	   	   	            		.bind('dblclick', toggle.bind(thisRow));
   	   	            	}
   	   	            }   	           
   	   	            if (edit) {
   	   	            	$(buttonSelector, this)
   	   	            		.bind('click', toggle.bind(this));
   	   	            	$(buttonCancel, this)
   	   	            		.bind('click', canceller.bind(this));
   	   	            	$(buttonRemove, this)
   	   	            		.bind('click', remover.bind(this)); 
   	   	            } 
   	   	           
   	   	       
   	   	            function toggle(e) {
   	   	            	e.preventDefault();
   	   	            	editing = !editing;
   	   	            	if (editing) {
   	   	            		edit(); 
   	   	            		cancelling = !cancelling;
   	   	            	} else {
   	   	            		save(); 
   	   	            		cancelling = !cancelling;
   	   	            	}               
   	   	            }
   	   	       
   	   	            function canceller(){
   	   	            	if(cancelling){
   	   	            		cancel();
   	   	            		editing = !editing;
   	   	            		cancelling = !cancelling;
   	   	            	}
   	   	            }
   	   	 
   	   	            function remover(){
   	   	            	remove();
   	   	            }
   	   			})	
   			}
   		},
   		// remove selected element
   		removeSelectedElement : function(controller,options,thisTable){
   			var removeSelectedElement = this;
   			$('#' + removeSelectedElement.tableName + "delete").on('click',function(){
   				thisTable.find('.data').each(function(){
   					// to complete
   				})
   			})
   		},
   		//create html of table
   		createHtml : function(start,data,pageSize,options,thisTable){
   			var champsTitle = [],
   				champsLength = [],
   				thisHtml = this;
   			//get the title of each column
   			function getTitleOfColumn(){
   				thisTable.find('th').each(function(){
   	   	        	champsTitle.push($(this).attr('name'));
   	   	        	if($(this).attr('length') != undefined){
   	   	        		champsLength[$(this).attr('name')] = $(this).attr('length');
   	   	        	}
   	   	        });
   			}
   			// bind the click event to checkbox
        	function bindEventOfCheckbox(){
        		$("input[name=check]").each(function() {
            		$(this).bind("click", function() {
            			var key=$(this).attr("key");
            			if (this.checked) {        				
            				data[key]['Checkbox']='1';
            			} else {
            				data[key]['Checkbox']='0';
            			}
            		});
            	});
        	}
        	
        	// contruire html
        	function construireHtml(){
        		thisTable.find('tbody').empty();     			
       			var isDelete = thisHtml.options.isDelete,
       				isEdit = thisHtml.options.isEdit,
       				isMail = thisHtml.options.isMail,
       				isAction = thisHtml.options.isAction,
       				champsFixed = thisHtml.options.champsFixed,
       				specialChamp = thisHtml.options.specialChamp,
       				noExportCSV = thisHtml.options.noExportCSV;
            	var html;
            	var actions;
            	var end = Number(start)+Number(pageSize);
            	if (end > data.length) {
            		end = data.length;
            	}
            	for(start; start < end; start++){
            		var key1=start;
            		var row = [];
            		row.push('<tr class="data">');
            		for(var i=0; i<champsTitle.length; i++){
            			if(champsTitle[i] == "id"){
            				row.push('<td data-id ="'+ champsTitle[i] + '" old="'+ data[key1][champsTitle[i]] + '" >'+ data[key1][champsTitle[i]] +'</td>'); 
            			}
            			else if(champsFixed.indexOf(champsTitle[i]) != -1){
            				if(typeof(data[key1][champsTitle[i]])=="undefined"){
            					row.push('<td data-fixed ="'+ champsTitle[i] + '" old= "" ></td>');
            				}else{        				
            					row.push('<td data-fixed ="'+ champsTitle[i] + '" old="'+ data[key1][champsTitle[i]] + '" >'+ data[key1][champsTitle[i]] +'</td>');          			        					
            				}
               		 	} 
            			else if (champsTitle[i] == "Actions" && isAction) {
               		 		actions='';
               		 		if(isEdit)
               		 		{
               		 			actions += '<a class="button button-small edit" title="Edit">' + '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>' + '</a>';
                   		 		actions += '<a class="button button-small cancel" title="Cancel">'	+ '<i class="fa fa-times" aria-hidden="true"></i>' + '</a>';
               		 		}
               		 		if(isDelete){
               		 			actions += '<a class="button button-small delete" title="Delete">'+ '<i class="fa fa-trash-o" aria-hidden="true"></i>' + '</a>';
               		 		}
               		 		if(isMail){
               		 			actions += '<a class="button button-small envelope" title="mail">' + '<i class="fa fa-envelope-o" aria-hidden="true"></i>' + "</a>";
               		 		};
               		 		row.push('<td class="actions" >' + actions + '</td>');
               		 	}
            			else if(champsTitle[i]== "Checkbox"){
               		 		if (data[key1][champsTitle[i]]=="0") {
               		 			row.push('<td>' + '<input type="checkbox" name="check" key="' + key1 + '">' + '</td>');
               		 		} else {
               		 			row.push('<td>' + '<input type="checkbox" name="check" checked key="' + key1 + '">' + '</td>');
               		 		}
               		 	}else{
               		 		if(typeof(data[key1][champsTitle[i]])=="undefined"){
               		 			row.push('<td data-field ="'+ champsTitle[i] + '" old= "" len="' + champsLength[champsTitle[i]] + '"></td>');
               		 		}else{  
               		 			row.push('<td data-field ="'+ champsTitle[i] + '" old="'+ data[key1][champsTitle[i]] + '" len="' + champsLength[champsTitle[i]] +'">'+ data[key1][champsTitle[i]] +'</td>');
               		 		} 
             		 	}
               	 	}           	 
            		row.push('</tr>');
               		row = row.join('');
               		var htmlCell = row;
               		row = $(row);
               		if(start%2 == 0){												
               			row.addClass("odd");
    					htmlCell = row.prop("outerHTML");
    				}else{
    					row.addClass("even");
    					htmlCell = row.prop("outerHTML");
    				}
    				
               		if(options.callbackFunction){
               			options.callbackFunction(row, data[key1]);
               			htmlCell = row.prop("outerHTML");
               		} 
               		html += htmlCell;
            	}
            	return html;
        	}
   			getTitleOfColumn();
   			
        	thisTable.find('tbody').append(construireHtml());
        	//call the function columnFilter
        	this.columnFilter(options,thisTable);
        	// call the function editable
        	this.editable(thisHtml.controller,options,thisTable);
        	
        	this.removeSelectedElement(thisHtml.controller,options,thisTable);
        	bindEventOfCheckbox();
   		},   		
   		// pagination function 
        paginate : function(start,data,options,thisTable) {
        	var pagination =this,
        		paginationId = "#" + pagination.tableName + "Pagination",
        		pageSizeContainer = "#" + pagination.tableName + "PageSizeSelected";
        	$(paginationId).empty();
        	Pagination(
        			paginationId,
					{	
						pageSizeContainer : pageSizeContainer,
						itemsCount : data.length,
						onPageSizeChange : function(ps) {
							console.log('changed to '+ ps);
						},
						onPageChange : function(paging) {
							start = paging.pageSize * (paging.currentPage - 1), 
							pagination.createHtml(start,data,paging.pageSize,options,thisTable);					
						}
			});		
        	return this;
        },        
   	}
   	/*
   	$.fn.DynamitablePos = function(options){
   		var dynamitablePos = new DynamitablePos(this, options);
   		return dynamitablePos.initiation(this,options);
   	}*/
   	
   	$.fn.DynamitablePos = function(options){
   		var dynamitablePos = new DynamitablePos(this, options);
		dynamitablePos.initiation(this,options);
		return dynamitablePos;
   	}
   	
   	
    function unblock() {
        $.unblockUI(); 
    }
    function block() {
        $.blockUI({ css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        },
        message: 'Veuillez patienter ...' }); 
    }
   
})(jQuery, window, document);

