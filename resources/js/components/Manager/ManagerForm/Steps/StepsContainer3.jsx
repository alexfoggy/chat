import React from "react";
import "../../../../../../public/css/components/form.css"
import { getUsers } from '../../../../api/api'
import CheckBoxList from "../../CheckBoxList";


import "../../../../../../public/css/components/block.css"
import "../../../../../../public/css/components/form.css"
const styles = {
    label: {
        fontWeight: 'bold',
        color: 'black',
        marginBottom: '10px',
        fontSize: '18px'
    },
    nav: {
        display: 'flex',
        justifyContent: 'center',
        padding: '20px'
    },
    form_group: {
        display: 'block'
    }
}

class StepContainer3 extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            users: [],
            courses: [],
            search: this.props.language,
            gender: "Male",
            voice: "Adult",
            country: this.props.country
        };


    }


    handleChangeGender = event => {
        this.setState({ gender: event.target.value });
    };
    handleChangeSearch = event => {
        this.setState({ search: event.target.value });
    };
    handleChangeSearchCountry = event => {
        this.setState({ country: event.target.value });
    };
    handleChangeVoice = event => {
        this.setState({ voice: event.target.value });
    };

    getUnique(arr, comp) {
        const unique = arr
            //store the comparison values in array
            .map(e => e[comp])

            // store the keys of the unique objects
            .map((e, i, final) => final.indexOf(e) === i && i)

            // eliminate the dead keys & store unique objects
            .filter(e => arr[e])

            .map(e => arr[e]);

        return unique;
    }

    componentDidMount() {
        getUsers().then(res => {
            this.setState({
                courses: res.data.data
            })
        })
    }
    onCheckBoxChange(checkName, isChecked) {
        let isAllChecked = (checkName === 'all' && isChecked);
        let isAllUnChecked = (checkName === 'all' && !isChecked);
        const checked = isChecked;

        const courses = this.state.courses.map((courses, index) => {
            if (isAllChecked || courses.id === checkName) {
                return Object.assign({}, courses, {
                    checked,
                });
            } else if (isAllUnChecked) {
                return Object.assign({}, courses, {
                    checked: false,
                });
            }
            return courses;
        });

        let isAllSelected = (courses.find((item) => item.checked === false) === -1) || isAllChecked;

        this.setState({
            courses,
            isAllSelected,
        });

    }

    render() {
        const l = this.props.language
        const c = this.props.country
        const uniqueGender = this.getUnique(this.state.courses, "gender");
        const uniqueVoice = this.getUnique(this.state.courses, "voice");
        const uniqueSearch = this.getUnique(this.state.courses, "main_language");
        const uniqueCountry = this.getUnique(this.state.courses, "country");

        const courses = this.state.courses;
        const gender = this.state.gender;
        const voice = this.state.voice;
        const search = this.state.search;
        const country = this.state.country;
        console.log(country)

        // const filterDropdown = courses.filter(p => {
        //     let gender = p.gender == null ? '' : p.gender
        //     return p.main_language
        //         // p.main_language.toLowerCase().includes(this.state.search.toLowerCase())
        //     // p.id.toLowerCase().includes(this.state.search.toLowerCase()) 



        // })
        const filterDropdown = courses.filter(function (result) {
            return result.main_language === search
                && result.country === country
                && result.gender === gender

            // && result.voice === voice
        });

        return (
            <div>
                <div className="block">
                    <div className="block-content">
                        <form className='project-form'>
                            <div className="row">
                                <div className="col-6" >
                                    <div className="form-group">
                                        <label style={styles.label} > Language </label>
                                        <div style={styles.form_group} className="form-group">
                                            <input defaultValue={l} onChange={this.handleChangeSearch} type="text" placeholder="Search..." style={{ marginBottom: '20px' }} />
                                        </div>
                                    </div>
                                </div>
                                <div className="col-2">
                                    <div className="form-group">
                                        <label style={styles.label} >Gender </label>          
                                                                       <div style={styles.form_group} className="form-group">
                                            <select onChange={this.handleChangeGender} >

                                                {uniqueGender.map(course => (
                                                    <option key={course.id} value={course.gender}>
                                                        {course.gender}
                                                    </option>

                                                ))}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-6" >
                                    <div className="form-group">
                                        <label style={styles.label} > Country </label>
                                        <div style={styles.form_group} className="form-group">
                                            <input defaultValue={c} onChange={this.handleChangeSearchCountry} type="text" placeholder="Search..." style={{ marginBottom: '20px' }} />
                                        </div>
                                    </div>
                                </div>
                                <div className="col-2">
                                    <label style={styles.label} >Voice</label>
                                    <div style={styles.form_group} className="form-group">
                                        <select value={this.state.voice} onChange={this.handleChangeVoice} >
                                            {uniqueVoice.map(course => (
                                                <option key={course.id} value={course.voice}>
                                                    {course.voice}
                                                </option>
                                            ))}
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>


                        <CheckBoxList
                            projectsId={this.props.projects}
                            control={this.props.control}
                            name={this.props.name}
                            users={filterDropdown}
                            isCheckedAll={this.state.isAllSelected}
                            onCheck={this.onCheckBoxChange.bind(this)}
                        />
                    </div>
                </div>
            </div >
        );
    }
}

export default StepContainer3