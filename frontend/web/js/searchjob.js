
brainApp.controller('JobSearchController', function ($scope, $http, $sce, $element, $compile) {
	
	$scope.currentDropdown = '';
	
	$scope.query = {};
	$scope.query["region"] = regions;
	$scope.query["skills"] = [];
	$scope.query["vacancies"] = [];
	$scope.query["branches"] = [];
	$scope.query["searchText"] = "";
	$scope.query.selectedSortOption = "new";

	$scope.branches = branches;
	$scope.vacancies = vacancies;
	$scope.jobscounturl = jobscounturl;
	$scope.jobssearchturl = jobssearchturl;
	
	$scope.isMoreJobs = false;
	$scope.jobsFilterCount = false;
	$scope.foundJobs = [];
	
	$scope.nextjobloading = false;
	$scope.isPageTitle = true;
	$scope.loadingSearchShow = false;
	
	$scope.showSOrtList = false;
	
	$scope.sortOptionList = [
		{value:"title", label:"Bezeichnung"},
		{value:"new", label:"Neuestes Angebot"},
		{value:"vacancy", label:"Vakanz"},
		{value:"startdate", label:"Startdatum"},
		{value:"branch", label:"Branche"},
	];
	
	$scope.showSortList = function (){
		$scope.showSOrtList = !$scope.showSOrtList;	
	}
	
	$scope.selectSortOption = function (item){
		$scope.query.selectedSortOption = item.value;
		$scope.showSOrtList = false;
	}
	
	$scope.getSelectedSortOption = function (){
		for(index in $scope.sortOptionList){
			if($scope.sortOptionList[index].value == $scope.query.selectedSortOption){
				return $scope.sortOptionList[index];
			}
		}	
		return false;
	}
	
	$scope.toggleDropdown = function (dropdown){
		if($scope.currentDropdown == dropdown){
			$scope.currentDropdown = ""; 
		}
		else{
			$scope.currentDropdown = dropdown;
		}	
	}
	
	$scope.closeDropdown = function (){
		$scope.currentDropdown = "";	
	}
	
	$scope.isRegionSelected = function (country, city){
		return  $scope.query["region"][country][city];
	}
	
	$scope.toggleRegion = function (country, city, ev){
		$scope.query["region"][country][city] = !$scope.query["region"][country][city];
		if(ev) ev.stopPropagation();
		createTags();
	}
	
	$scope.isSkillSelected = function (skill){
		return $scope.query["skills"].indexOf(skill) > -1;
	}
	
	$scope.toggleSkill = function (skill, ev){
		var index = $scope.query["skills"].indexOf(skill);
		if(index === -1){
			$scope.query["skills"].push(skill);
		}
		else{
			$scope.query["skills"].splice(index, 1);   
		}
		if(ev) ev.stopPropagation();
		createTags();
	}
	
	$scope.isVacancySelected = function (id){
		return $scope.query["vacancies"].indexOf(id) > -1;
	}
	
	$scope.toggleVacancy = function (id, ev){
		var index = $scope.query["vacancies"].indexOf(id);
		
		
		if(index === -1){
			$scope.query["vacancies"].push(id);
		}
		else{
			$scope.query["vacancies"].splice(index, 1);   
		}
		if(ev) ev.stopPropagation();
		createTags();
	}
	
	$scope.isBranchSelected = function (id){
		return $scope.query["branches"].indexOf(id) > -1;
	}
	
	$scope.toggleBranch = function (id, ev){
		var index = $scope.query["branches"].indexOf(id);
		if(index === -1){
			$scope.query["branches"].push(id);
		}
		else{
			$scope.query["branches"].splice(index, 1);   
		}
		if(ev) ev.stopPropagation();
		createTags();
	}

	$scope.hasTags = function (part){
		
		if(part === "region" || part === undefined){
			for(var countryName in $scope.query["region"]){
				var countryList = $scope.query["region"][countryName];
				for(var city in countryList){
					if(countryList[city]){
						return true;
					}
				}
			}			
		}
		
		if(part === "skill" || part === undefined){
			for(var index in $scope.query["skills"]){			
				return true;
			}
		}
		
		if(part === "vacancy" || part === undefined){
			for(var index in $scope.query["vacancies"]){			
				return true;
			}
		}
		
		if(part === "branch" || part === undefined){
			for(var index in $scope.query["branches"]){
				return true;
			}
		}
		
		return false;
	}

	$scope.searchJobs = function (){
		
		//alert(JSON.stringify($scope.query)); 
		$scope.closeDropdown();
		$http({
	        method : "POST",
	        headers: {
	        	'Content-type': 'application/json; charset=UTF-8',
	        },
	        url : $scope.jobssearchturl,
	        data : $scope.query
	    }).then(function mySuccess(response) {
	    	$scope.foundJobs = response.data.data;
	    	$scope.jobsFilterCount = response.data.count;
	    	$scope.isMoreJobs = response.data.isMoreJobs;
	        //$scope.test = response.data;
	    }, function myError(response) {
	        alert(response.statusText);
	        $scope.test = response.data;
	    });
		
	}

	$scope.getJobCount = function(){
		
		//alert(JSON.stringify($scope.query)); 
		
		$http({
	        method : "POST",
	        headers: {
	        	'Content-type': 'application/json; charset=UTF-8',
	        },
	        url : $scope.jobscounturl,
	        data : $scope.query
	    }).then(function mySuccess(response) {
	    	$scope.jobsFilterCount = response.data.count;
	    	
	        //$scope.test = response.data;
	    }, function myError(response) {
	        alert(response.statusText);
	        $scope.test = response.data;
	    });
	}
	
	function createTags(){
		var tags = "";
		
		for(var countryName in $scope.query["region"]){
			var countryList = $scope.query["region"][countryName];
			for(var city in countryList){
				if(countryList[city]){
					tags += city === 'self' ? createTag(countryName, 'region', countryName, 'self') : createTag(city, 'region', countryName, city);
				}
			}
		}
		
		for(var index in $scope.query["skills"]){			
			tags += createTag($scope.query["skills"][index], 'skills', $scope.query["skills"][index]);
		}
		
		for(var index in $scope.query["vacancies"]){			
			var id = $scope.query["vacancies"][index];
			tags += createTag($scope.vacancies[id], 'vacancies', id);
		}
		
		for(var index in $scope.query["branches"]){
			var id = $scope.query["branches"][index];
			tags += createTag($scope.branches[id], 'branches', id);
		}
		
		//tags = $sce.trustAsHtml(tags);
		
		var divTags = $(".search-job-selectedtags-tags");

		divTags.html(tags);
        $compile(divTags.contents())($scope);
        
        $scope.getJobCount();
        //alert(tags);
	}
	
	function createTag(tag, part, item1, item2){
		part = part === undefined ? '' : part;
		item1 = item1 === undefined ? '' : item1;
		item2 = item2 === undefined ? '' : item2;
		
		tagHtml = '<div class="each-criteria"><em>' + tag + '</em><span data-part="' + part + '" data-item1="' + item1 + '" data-item2="' + item2 + '" ng-click="removeTag(\'' + part + '\', \'' + item1 + '\', \'' + item2 + '\')"></span></div>';
		return tagHtml;
	}
	
	$scope.removeTag = function (part, item1, item2){
		//alert(part + ", " + item1 + ", " + item2);
		if(part === "region"){
			$scope.toggleRegion(item1, item2, false);
		}
		if(part === "branches"){
			item1 = new Number(item1);
			item1 = item1 + 0;
			$scope.toggleBranch(item1, false);
		}
		if(part === "vacancies"){
			item1 = new Number(item1);
			item1 = item1 + 0;
			$scope.toggleVacancy(item1, false);
		}
		if(part === "skills"){
			$scope.toggleSkill(item1, false);
		}
		
		$scope.closeDropdown();
		createTags();
	}

	
	
    
	

	$scope.searchJobs();

	
	
    
});


