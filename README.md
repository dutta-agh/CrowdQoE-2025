# CrowdQoE-2025: Crowdsourcing Subjective Video Quality Assessment

## Overview
This repository contains the code and metadata for a crowdsourcing-based subjective video quality assessment study conducted by the AGH Video Quality of Experience (QoE) Team at AGH University of Kraków.

Two separate experiments were carried out, each with a dedicated video database.

---

## Databases

### 📁 Database A — Long & Short Video Assessment
- **Total Videos:** 80 (60 Short + 20 Long)
- **Task:** Participants rated video quality on a 5-point scale
  (Excellent, Good, Fair, Poor, Bad)
- **Duration per session:** ~60 minutes
- **📥 Download Database A:**  
  [Google Drive – Database A](https://drive.google.com/drive/folders/1uidHtLidfTjTceQXaRVbvE0bDbbWh1Uk)

---

### 📁 Database B — Repeated Assessment
- **Total Videos:** 40 Short videos × 3 sessions = 120 ratings
- **Task:** Participants rated video quality on a 5-point scale
  (Excellent, Good, Fair, Poor, Bad)
- **📥 Download Database B:**  
  [Google Drive – Database B](https://drive.google.com/drive/folders/1Z0mWb-pXaTXScrxdg3bxScVKMBYwJS9L)

---

## Repository Structure
```
CrowdQoE-2025/
│
├── README.md
├── Database_A/
│   ├── metadata/        ← Video metadata (CSV/Excel)
│   └── links.md         ← Google Drive download link
│
├── Database_B/
│   ├── metadata/        ← Video metadata (CSV/Excel)
│   └── links.md         ← Google Drive download link
│
├── experiment_A/        ← Full source code for Experiment A
│   ├── index.php        ← Homepage with ITU-T P.910 Guidelines 
│   ├── int.php          ← Check Internet Speed (Minimum 40 Mbps)
│   ├── nq-int.php       ← Not Qualify with Minimum Internet Speed
│   ├── res.php          ← Check Monitor/ Screen Resolution (Minimum Full HD 1920×1080) 
│   ├── nq-res.php       ← Not Qualify with Minimum Monitor/ Screen Resolution
│   ├── info.php         ← Questionnaire (Country, Age, Gender, Education Group, Education Type, Mood, Tiredness, Interests)
│   ├── qoe.php          ← Warning to Start Video Sequences (Assessment)
│   ├── video.php        ← One by one, videos are fetching from the config.xlsx file (Random Order Sequence)
│   ├── vote.php         ← Each of the videos with a 5-point Absolute Category Rating (ACR) Scale (Excellent, Good, Fair, Poor, or Bad)
│   ├── tq.php           ← Assessment Successfully Completed & Thank you for Participation
│   ├── vote_data.csv    ← Collecting the Vote Data from the User/ Participants/ Viewer (Unique Session ID, Timestamp in UTC, Response Time in ms)
│   ├── css/
│   ├── js/
│   └── php/
│
├── experiment_B/        ← Full source code for Experiment B
│   ├── index.php        ← Homepage with ITU-T P.910 Guidelines 
│   ├── int.php          ← Check Internet Speed (Minimum 40 Mbps)
│   ├── nq-int.php       ← Not Qualify with Minimum Internet Speed
│   ├── res.php          ← Check Monitor/ Screen Resolution (Minimum Full HD 1920×1080) 
│   ├── nq-res.php       ← Not Qualify with Minimum Monitor/ Screen Resolution
│   ├── info.php         ← Questionnaire (Country, Age, Gender, Education Group, Education Type, Mood, Tiredness, Interests)
│   ├── qoe.php          ← Warning to Start Video Sequences (Assessment)
│   ├── video.php        ← One by one, videos are fetching from the config.xlsx file (Pseudo-Random Order Sequence)
│   ├── vote.php         ← Each of the videos with a 5-point Absolute Category Rating (ACR) Scale (Excellent, Good, Fair, Poor, or Bad)
│   ├── tq.php           ← Assessment Successfully Completed & Thank you for Participation
│   ├── vote_data.csv    ← Collecting the Vote Data from the User/ Participants/ Viewer (Unique Session ID, Timestamp in UTC, Response Time in ms)
│   ├── css/
│   ├── js/
│   └── php/
│
└── docs/                ← Additional documentation
```

---

## Experiment Setup
- **Platform:** Web-based crowdsourcing (PHP, JavaScript, HTML)
- **Browser:** Google Chrome (latest, Incognito mode recommended)
- **Resolution:** Full HD (1920×1080)
- **Internet Speed:** Minimum 40 Mbps
- **Device:** PC, Desktop, or Laptop only

---

## Citation
If you use this dataset or code in your research, please cite:
```
@misc{dutta2025crowdqoe,
  author       = {Dutta, Avrajyoti},
  title        = {{CrowdQoE-2025: Crowdsourcing Subjective Video Quality Assessment}},
  year         = {2025},
  publisher    = {GitHub},
  howpublished = {\url{https://github.com/dutta-agh/CrowdQoE-2025}}
}
```

---

## Contact
For any inquiries, please contact:  
📧 [avrajyoti.dutta@agh.edu.pl](mailto:avrajyoti.dutta@agh.edu.pl)  
🌐 [AGH QoE Team](https://qoe.agh.edu.pl/pl/)

---

## License
This project is licensed under the MIT License.  
© 2026 Avrajyoti Dutta, AGH University of Kraków


