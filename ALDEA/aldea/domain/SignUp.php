<?php
class SignUp {
    // Step 1
  private $id;
    private $period;
    private $studentId;
    private $institutional;
    private $degree_id;
    private $mention;
    private $section;
    private $isNewStudent;
    private $isRepeating;
    private $isPendingCourse;
    private $coursesIds;

    private $lastNameFather;
    private $lastNameMother;
    private $firstName;
    private $secondName;
    private $maritalStudent;
    private $gender;
    private $birthOrder;
    private $laterality;
    private $birthDate;
    private $birthPlace;
    private $birthStateId;
    private $municipalityId;
    private $parishId;
    private $nationality;
    private $birthCountry;
    private $email_students;
    private $mobilePhone;
    private $previousSchool;
    private $anotherAge;

    private $facebook;
    private $whatsapp;
    private $tiktok;
    private $instagram;
    private $home_stateId;
    private $home_municipalityId;
    private $home_parishId;
    private $population;
    private $road;
    private $roadType;
    private $locationZone;
    private $indigenousCommunities;
    private $urbanization;
    private $home_address;

    private $weight;
    private $height;
    private $shirt_size;
    private $pants_size;
    private $shoe_size;

    private $vaccinated;
    private $vaccine_name;
    private $firstDoseDate;
    private $secondDoseDate;
    private $thirdDoseDate;
    private $hasDisease;
    private $diseaseName;
    private $hasChronicDisease;
    private $chronicDisease;
    private $isAllergicToMedication;
    private $medicationAllergy;
    private $isAllergicToFood;
    private $foodAllergy;
    private $livingWith;
    private $bloodType;
    private $isConditionType;
    private $term;

    private $isCamain;
    private $cameraStatus;
    private $isTablet;
    private $tabletStatus;
    private $hasPhone;
    private $phoneStatus;
    private $hasScholarship;
    private $scholarshipName;
    private $cardCode;
    private $cardSerial;

    private $isPregnant;
    private $pregnancyStage;
    private $belongsToEthnicGroup;
    private $ethnicGroup;
    private $housingType;
    private $housingCondition;
    private $infrastructureCondition;
    private $emergencyContactName;
    private $emergencyPhoneOne;
    private $emergencyPhoneTwo;
    private $emergencyRelationship;

    private $numberOfChildren;
    private $minimumWages;
    private $participationSchedule;
    private $authorization;

    private $created_at;
    private $updated_at;
    private $status;

    public function __construct($id = null) {
    $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function toArray(): array {
       return get_object_vars($this); 
    } 

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }

    public function isValid() {
        // Lógica de validación (puedes agregar más)
        return !empty($this->firstName) && !empty($this->lastNameFather);
    }
    
    public static function fromArray(array $data = []): self {
        $instance = new self();
        $flattenedData = [];
        foreach ($data as $step => $stepData) {
            if (is_array($stepData)) {
                foreach ($stepData as $key => $value) {
                    $flattenedData[$key] = $value;
                }
            }
        }
        //optional
        if (isset($flattenedData['coursesIds']) && is_array($flattenedData['coursesIds'])) {
            $flattenedData['coursesIds'] = implode(',', $flattenedData['coursesIds']); 
        }

        foreach ($flattenedData as $key => $value) {
            if (property_exists($instance, $key)){
                $instance->$key = $value; 
            }  
            
        }

        return $instance;
    }
    public function getStudentId() {
        return $this->studentId;
    }

    public function setStudentId($studentId) {
        $this->studentId = $studentId;
    }
    
}
?>


