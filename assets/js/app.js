import '../css/app.scss';

import { Dropdown } from 'bootstrap';

document.addEventListener('DOMContentLoaded', () =>{
    enabledDropdowns();
})


const enabledDropdowns = () =>{
    const dropdownElementList = document.querySelectorAll('.dropdown-toggle')
const dropdownList = [...dropdownElementList].map(dropdownToggleEl => new bootstrap.Dropdown(dropdownToggleEl))
}