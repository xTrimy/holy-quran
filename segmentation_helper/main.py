# read text files line by line and add lines to array
# then write array to text file
import json
reciter = "Nasser_Alqatami"
all_data = []
for i in range(1, 115):
    # change i to format 001
    file = "{:03d}.txt".format(i)
    with open('./'+reciter+"/"+file, 'r') as f:
        data = []
        for line in f:
            line = line.replace('\n', '')
            data.append(int(line)/1000)
        f.close()
        segments = data
        surah = i
        item = {"surah":surah, "segments":segments}
        all_data.append(item)

# write all_data to file as json with indentation
with open('./'+reciter+'_all_data.json', 'w') as f:
    json.dump(all_data, f, indent=4)
f.close()
