

# import sys
# import re
# import os
# from collections import defaultdict
# from fpdf import FPDF

# def extract_questions(text):
#     # Regex to match questions starting with common question words
#     pattern = r"(?:What|Why|How|When|Where|Who|Which)[^?]+\?"
#     questions = re.findall(pattern, text, flags=re.IGNORECASE)
#     return set(q.strip().lower() for q in questions)

# def read_text(path):
#     if path.lower().endswith('.pdf'):
#         try:
#             import PyPDF2
#             text = ""
#             with open(path, 'rb') as file:
#                 reader = PyPDF2.PdfReader(file)
#                 for page in reader.pages:
#                     page_text = page.extract_text()
#                     if page_text:
#                         text += page_text + "\n"
#             return text
#         except Exception as e:
#             print(f"Error reading PDF {path}: {e}")
#             return ""
#     elif path.lower().endswith('.txt'):
#         try:
#             with open(path, 'r', encoding='utf-8') as f:
#                 return f.read()
#         except Exception as e:
#             print(f"Error reading TXT {path}: {e}")
#             return ""
#     return ""

# if __name__ == "__main__":
#     file_paths = sys.argv[1:]

#     if not file_paths:
#         print("No file paths provided.")
#         sys.exit(1)

#     question_occurrences = defaultdict(set)  # questions: set of file indices

#     for idx, file_path in enumerate(file_paths):
#         if not os.path.exists(file_path):
#             print(f"File not found: {file_path}")
#             continue

#         content = read_text(file_path)
#         if not content.strip():
#             print(f"No text found in: {file_path}")
#             continue

#         questions = extract_questions(content)
#         for question in questions:
#             question_occurrences[question].add(idx)

#     # Filter only questions that appear in 2 or more files
#     common_questions = [q for q, files in question_occurrences.items() if len(files) >= 2]

#     if common_questions:
#         print("Common Questions Across Files:\n")
#         for q in sorted(common_questions):
#             print(f"- {q}")

        
#     else:
#         print("No common questions found.")

# import sys
# import os
# import re
# import pdfplumber
# from fpdf import FPDF
# from collections import defaultdict

# def extract_questions(text):
#     # Basic exam-style question matcher
#     pattern = r"((What|Why|How|When|Where|Who|Which|Define|Explain|Write|List|Describe|Convert)[^?.:\n]{5,}[\?:\.])"
#     matches = re.findall(pattern, text, flags=re.IGNORECASE)
#     return set(m[0].strip().lower() for m in matches)

# def read_text(path):
#     text = ""
#     try:
#         with pdfplumber.open(path) as pdf:
#             for page in pdf.pages:
#                 page_text = page.extract_text()
#                 if page_text:
#                     text += page_text + "\n"
#     except Exception as e:
#         print(f" Failed to read {path}: {e}")
#     return text

# def generate_pdf(questions, output_path):
#     pdf = FPDF()
#     pdf.add_page()
#     pdf.set_font("Arial", "B", 14)
#     pdf.cell(0, 10, "CLEAN COMMON QUESTIONS REPORT", ln=True, align='C')
#     pdf.set_font("Arial", "", 12)
#     pdf.cell(0, 10, "Generated without OCR", ln=True, align='C')
#     pdf.ln(10)

#     pdf.set_font("Arial", size=12)
#     for i, q in enumerate(sorted(questions), 1):
#         pdf.multi_cell(0, 10, f"Q{i}. {q.capitalize()}")
#         pdf.ln(2)

#     pdf.output(output_path)
#     print(f"\n Clean PDF generated at: {output_path}")

# def main():
#     files = sys.argv[1:]
#     if len(files) < 2:
#         print(" Please provide at least two PDF files.")
#         return

#     question_map = defaultdict(set)

#     for idx, file in enumerate(files):
#         print(f"\n Reading {file}")
#         content = read_text(file)
#         print(f" Text preview:\n{content[:300]}\n")
#         questions = extract_questions(content)
#         print(f"{len(questions)} questions found")
#         for q in questions:
#             question_map[q].add(idx)

#     common = [q for q, sources in question_map.items() if len(sources) >= 2]

#     if common:
#         print("\n Common Questions Found:\n")
#         for q in sorted(common):
#             print(f"- {q}")
#         generate_pdf(common, "Clean_Common_Questions_No_OCR.pdf")
#     else:
#         print(" No common questions found.")

# if __name__ == "__main__":
#     main()







import sys
import os
import re
import pdfplumber
from fpdf import FPDF
from collections import defaultdict
from difflib import SequenceMatcher


def extract_questions(text):
    
        lines = text.splitlines()
        questions = []
        for line in lines:
            line = line.strip().lower()
            if len(line) > 15 and any(kw in line for kw in ["what", "why", "how", "define", "explain", "describe", "list", "discuss", "write", "compare"]):
                questions.append(line)
        return questions



def read_text(path):
        text = ""
        try:
            with pdfplumber.open(path) as pdf:
                for page in pdf.pages:
                    page_text = page.extract_text()
                    if page_text:
                        text += page_text + "\n"
        except Exception as e:
            print(f" Failed to read {path}: {e}")
        return text


def similar(a, b):
        return SequenceMatcher(None, a, b).ratio()


def find_common_questions(all_questions, threshold=0.65):
        common = []
        used = set()

        for i in range(len(all_questions)):
            for j in range(i + 1, len(all_questions)):
                q1 = all_questions[i]
                q2 = all_questions[j]
                if similar(q1, q2) >= threshold:
                    if q1 not in used and q2 not in used:
                        common.append(q1)
                        used.add(q1)
                        used.add(q2)
        return common

        

def generate_pdf(questions, output_path):
        pdf = FPDF()
        pdf.add_page()
        pdf.set_font("Arial", "B", 14)
        pdf.cell(0, 10, "CLEAN COMMON QUESTIONS REPORT", ln=True, align='C')
        pdf.set_font("Arial", "", 12)
        pdf.cell(0, 10, "Generated using fuzzy matching (no OCR)", ln=True, align='C')
        pdf.ln(10)

        pdf.set_font("Arial", size=12)
        for i, q in enumerate(sorted(questions), 1):
            pdf.multi_cell(0, 10, f"Q{i}. {q.capitalize()}")
            pdf.ln(2)

        pdf.output(output_path)
        print(f"\n PDF created at: {output_path}")


def main():
        files = sys.argv[1:]
        if len(files) < 2:
            print(" Please provide at least two PDF files.")
            return

        all_questions = []

        for file in files:
            content = read_text(file)
            # print(f" Preview:\n{content[:300]}")
            questions = extract_questions(content)
            # print(f" Found {len(questions)} questions")
            all_questions.extend(questions)

        if not all_questions:
            print(" No questions extracted from any file.")
            return

        common = find_common_questions(all_questions)

        if common:
            print("\n Common Questions:\n")
            for q in sorted(common):
                print(f"- {q}")
        else:
            print(" No common questions found.")

    
if __name__ == "__main__":
        main()


